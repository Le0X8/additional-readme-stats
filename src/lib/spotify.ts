import { ROOT, SPOTIFY_ID, SPOTIFY_SECRET } from '$env/static/private';
import { query } from '@neokit-dev/relational';
import {
	SpotifyApi,
	type AccessToken,
	type Artist,
	type PlayHistory,
	type Track
} from '@spotify/web-api-ts-sdk';

export function createApi(token: AccessToken) {
	return SpotifyApi.withAccessToken(SPOTIFY_ID, token);
}

export async function codeToken(code: string): Promise<AccessToken> {
	const body = new URLSearchParams({
		code,
		redirect_uri: ROOT + '/spotify/callback',
		grant_type: 'authorization_code'
	});

	const response = await fetch('https://accounts.spotify.com/api/token', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			Authorization: `Basic ${btoa(`${SPOTIFY_ID}:${SPOTIFY_SECRET}`)}`
		},
		body
	});

	return await response.json();
}

export async function refreshToken(
	refreshToken: string,
	id: string = SPOTIFY_ID,
	secret: string = SPOTIFY_SECRET
): Promise<AccessToken> {
	const body = new URLSearchParams({
		refresh_token: refreshToken,
		grant_type: 'refresh_token'
	});

	const response = await fetch('https://accounts.spotify.com/api/token', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			Authorization: `Basic ${btoa(`${id}:${secret}`)}`
		},
		body
	});

	return await response.json();
}

export async function usernameToken(username: string): Promise<AccessToken> {
	const response = (
		await query(
			'SELECT clientId, clientSecret, refreshToken FROM spotify WHERE username = ?',
			username
		)
	)[0];

	return await refreshToken(
		response.refreshToken as string,
		response.clientId as string,
		response.clientSecret as string
	);
}

export async function getTop(
	type: 'artists' | 'tracks',
	time: 'short_term' | 'medium_term' | 'long_term',
	username: string
) {
	const cachedTop = await getCachedTop(type, time, username);
	if (cachedTop) return cachedTop;

	const token = await usernameToken(username);
	const api = createApi(token);

	const top = (await api.currentUser.topItems(type, time, 10, 0)).items;
	await cacheTop(type, time, username, top);

	if (type === 'tracks')
		return (top as Track[]).map((track) => ({
			track: track.name,
			artist: track.artists.map((artist) => artist.name).join(', '),
			img: track.album.images[0].url,
			id: track.id
		}));

	return (top as Artist[]).map((artist) => ({
		artist: artist.name,
		img: artist.images[0].url,
		id: artist.id
	}));
}

async function getCachedTop(
	type: 'artists' | 'tracks',
	time: 'short_term' | 'medium_term' | 'long_term',
	username: string
) {
	if (type === 'tracks') {
		const cols = Array.from({ length: 10 }, (_, i) => `track${i}, artist${i}, img${i}, id${i}`);
		let table = 'spotifyTopTracksAllTime';
		switch (time) {
			case 'short_term':
				table = 'spotifyTopTracksMonth';
				break;
			case 'medium_term':
				table = 'spotifyTopTracksHalfYear';
				break;
		}
		const result = (
			await query(`SELECT ${cols.join(', ')} FROM ${table} WHERE username = ?`, username)
		)[0];
		if (!result) return;
		return Array.from({ length: 10 }, (_, i) => ({
			track: result[`track${i}`],
			artist: result[`artist${i}`],
			img: result[`img${i}`],
			id: result[`id${i}`]
		}));
	}
	const cols = Array.from({ length: 10 }, (_, i) => `artist${i}, img${i}, id${i}`);
	let table = 'spotifyTopArtistsAllTime';
	switch (time) {
		case 'short_term':
			table = 'spotifyTopArtistsMonth';
			break;
		case 'medium_term':
			table = 'spotifyTopArtistsHalfYear';
			break;
	}
	const result = (
		await query(`SELECT ${cols.join(', ')} FROM ${table} WHERE username = ?`, username)
	)[0];
	if (!result) return;
	return Array.from({ length: 10 }, (_, i) => ({
		artist: result[`artist${i}`],
		img: result[`img${i}`],
		id: result[`id${i}`]
	}));
}

async function cacheTop(
	type: 'artists' | 'tracks',
	time: 'short_term' | 'medium_term' | 'long_term',
	username: string,
	data: (Artist | Track)[]
) {
	if (type === 'tracks') {
		const cols = Array.from({ length: 10 }, (_, i) => `track${i}, artist${i}, img${i}, id${i}`);
		const values = Array.from({ length: 10 }, (_, i) => [
			(data[i] as Track).name,
			(data[i] as Track).artists.map((artist) => artist.name).join(', '),
			(data[i] as Track).album.images[0].url,
			data[i].id
		]);
		let table = 'spotifyTopTracksAllTime';
		switch (time) {
			case 'short_term':
				table = 'spotifyTopTracksMonth';
				break;
			case 'medium_term':
				table = 'spotifyTopTracksHalfYear';
				break;
		}

		await query(
			`INSERT INTO ${table} (username, ${cols.join(', ')}, expiration_time) VALUES (${'?, '.repeat(cols.length * 4 + 1)} ?)`,
			username,
			...values.flat(),
			Math.floor(Date.now() / 1000) + 86400
		);
		return;
	}
	const cols = Array.from({ length: 10 }, (_, i) => `artist${i}, img${i}, id${i}`);
	const values = Array.from({ length: 10 }, (_, i) => [
		(data[i] as Artist).name,
		(data[i] as Artist).images[0].url,
		data[i].id
	]);
	let table = 'spotifyTopArtistsAllTime';
	switch (time) {
		case 'short_term':
			table = 'spotifyTopArtistsMonth';
			break;
		case 'medium_term':
			table = 'spotifyTopArtistsHalfYear';
			break;
	}

	await query(
		`INSERT INTO ${table} (username, ${cols.join(', ')}, expiration_time) VALUES (${'?, '.repeat(cols.length * 3 + 1)} ?)`,
		username,
		...values.flat(),
		Math.floor(Date.now() / 1000) + 86400
	);
}

export async function getRecents(username: string) {
	const cachedRecents = await getCachedRecents(username);
	if (cachedRecents) return cachedRecents;

	const token = await usernameToken(username);
	const api = createApi(token);

	const recents = (await api.player.getRecentlyPlayedTracks(10)).items;
	await cacheRecents(username, recents);

	return recents.map((recent) => ({
		track: recent.track.name,
		artist: recent.track.artists.map((artist) => artist.name).join(', '),
		img: recent.track.album.images[0].url,
		id: recent.track.id
	}));
}

async function getCachedRecents(username: string) {
	const cols = Array.from({ length: 10 }, (_, i) => `track${i}, artist${i}, img${i}, id${i}`);
	const result = (
		await query(`SELECT ${cols.join(', ')} FROM spotifyRecentTracks WHERE username = ?`, username)
	)[0];
	if (!result) return;
	return Array.from({ length: 10 }, (_, i) => ({
		track: result[`track${i}`],
		artist: result[`artist${i}`],
		img: result[`img${i}`],
		id: result[`id${i}`]
	}));
}

async function cacheRecents(username: string, data: PlayHistory[]) {
	const cols = Array.from({ length: 10 }, (_, i) => `track${i}, artist${i}, img${i}, id${i}`);
	const values = Array.from({ length: 10 }, (_, i) => [
		data[i].track.name,
		data[i].track.artists.map((artist) => artist.name).join(', '),
		data[i].track.album.images[0].url,
		data[i].track.id
	]);

	await query(
		`INSERT INTO spotifyRecentTracks (username, ${cols.join(', ')}, expiration_time) VALUES (${'?, '.repeat(cols.length * 4 + 1)} ?)`,
		username,
		...values.flat(),
		Math.floor(Date.now() / 1000) + 7200
	);
	return;
}
