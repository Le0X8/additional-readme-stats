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
	username: string,
	limit = 5
): Promise<
	{
		track?: string;
		artist: string;
		img: string;
		id: string;
	}[]
> {
	const cachedTop = await getCachedTop(type, time, username);
	if (cachedTop)
		return cachedTop.slice(0, limit) as {
			track?: string;
			artist: string;
			img: string;
			id: string;
		}[];

	const token = await usernameToken(username);
	const api = createApi(token);

	const top = (await api.currentUser.topItems(type, time, 10, 0)).items;
	await cacheTop(type, time, username, top);

	if (type === 'tracks')
		return (top as Track[]).slice(0, limit).map((track) => ({
			track: track.name,
			artist: track.artists.map((artist) => artist.name).join(', '),
			img: track.album.images[0].url,
			id: track.id
		}));

	return (top as Artist[]).slice(0, limit).map((artist) => ({
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
		await query(`DELETE FROM ${table} WHERE expiration_time < ?`, Math.floor(Date.now() / 1000));
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
	await query(`DELETE FROM ${table} WHERE expiration_time < ?`, Math.floor(Date.now() / 1000));
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

export async function getRecents(
	username: string,
	limit = 5
): Promise<
	{
		track: string;
		artist: string;
		img: string;
		id: string;
	}[]
> {
	const cachedRecents = await getCachedRecents(username);
	if (cachedRecents)
		return cachedRecents.slice(0, limit) as {
			track: string;
			artist: string;
			img: string;
			id: string;
		}[];

	const token = await usernameToken(username);
	const api = createApi(token);

	const recents = (await api.player.getRecentlyPlayedTracks(10)).items;
	await cacheRecents(username, recents);

	return recents.slice(0, limit).map((recent) => ({
		track: recent.track.name,
		artist: recent.track.artists.map((artist) => artist.name).join(', '),
		img: recent.track.album.images[0].url,
		id: recent.track.id
	}));
}

async function getCachedRecents(username: string) {
	await query(
		'DELETE FROM spotifyRecentTracks WHERE expiration_time < ?',
		Math.floor(Date.now() / 1000)
	);
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
		Math.floor(Date.now() / 1000) + 300
	);
	return;
}

export async function getCurrent(
	username: string,
	force = false
): Promise<{
	device: string;
	deviceType: string;
	volume: number;
	shuffle: boolean;
	repeat: string;
	playing: boolean;
	type: string;
	track: string;
	artist: string;
	img: string;
	id: string;
} | null> {
	const cachedCurrent = await getCachedCurrent(username);
	if (cachedCurrent)
		return cachedCurrent as {
			device: string;
			deviceType: string;
			volume: number;
			shuffle: boolean;
			repeat: string;
			playing: boolean;
			type: string;
			track: string;
			artist: string;
			img: string;
			id: string;
		};
	const token = await usernameToken(username);
	const api = createApi(token);

	const current = await getCurrentTrack(api);
	await cacheCurrent(username, current);

	return (
		current ??
		(force
			? {
					device: 'offline',
					deviceType: 'speaker',
					volume: 0,
					shuffle: false,
					repeat: 'off',
					playing: false,
					type: 'track',
					track: 'Nothing',
					artist: 'No one',
					img: 'https://i.scdn.co/image/ab67616d00001e0287b1ed12660fd880d2d3729d',
					id: '4HyefsBihebUexaNmDHYa3'
				}: null)
	);
}

async function getCachedCurrent(username: string) {
	await query(
		'DELETE FROM spotifyCurrentTrack WHERE expiration_time < ?',
		Math.floor(Date.now() / 1000)
	);
	const result = (await query(`SELECT * FROM spotifyCurrentTrack WHERE username = ?`, username))[0];
	if (!result) return null;
	return {
		device: result.device,
		deviceType: result.device_type,
		volume: result.volume,
		shuffle: !!result.shuffle,
		repeat: result.repeat,
		playing: !!result.playing,
		type: result.playtype,
		track: result.track,
		artist: result.artist,
		img: result.img,
		id: result.id
	};
}

async function cacheCurrent(
	username: string,
	data: {
		device: string;
		deviceType: string;
		volume: number;
		shuffle: boolean;
		repeat: string;
		playing: boolean;
		type: string;
		track: string;
		artist: string;
		img: string;
		id: string;
	} | null
) {
	if (!data) return;

	await query(
		`INSERT INTO spotifyCurrentTrack (username, device, device_type, volume, shuffle, repeat, playing, playtype, track, artist, img, id, expiration_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
		username,
		data.device,
		data.deviceType,
		data.volume,
		data.shuffle,
		data.repeat,
		data.playing,
		data.type,
		data.track,
		data.artist,
		data.img,
		data.id,
		Math.floor(Date.now() / 1000) + 120
	);
}

async function getCurrentTrack(api: SpotifyApi) {
	const track = {
		device: 'Unknown',
		deviceType: 'speaker',
		volume: 100,
		shuffle: false,
		repeat: 'off',
		playing: false,
		type: 'track',
		track: 'Unknown',
		artist: 'Unknown',
		img: 'https://fakeimg.pl/64',
		id: '0000000000000000000000'
	};

	const playbackState = await api.player.getPlaybackState();

	track.device = playbackState?.device?.name ?? 'Unknown';
	track.deviceType = playbackState?.device?.type?.toLowerCase() ?? 'speaker';
	track.volume = playbackState?.device?.volume_percent ?? 100;
	track.shuffle = playbackState?.shuffle_state ?? false;
	track.repeat = playbackState?.repeat_state ?? 'off';
	track.playing = playbackState?.is_playing ?? true;

	if (playbackState?.item) {
		const currentTrack = playbackState.item;
		track.type = currentTrack.type;
		track.track = currentTrack.name;
		const ctArtists = (currentTrack as { artists?: { name: string }[] }).artists;
		track.artist = ctArtists ? ctArtists.map((artist) => artist.name).join(', ') : 'Unknown';
		const ctAlbum = (currentTrack as { album?: { images: { url: string }[] } }).album;
		track.img = ctAlbum ? ctAlbum.images[0]?.url : 'https://fakeimg.pl/64';
		track.id = currentTrack.id;
	} else {
		return null;
	}

	return track;
}
