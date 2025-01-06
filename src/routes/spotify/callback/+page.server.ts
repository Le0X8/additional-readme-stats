import { SPOTIFY_ID, SPOTIFY_SECRET } from '$env/static/private';
import { createApi, codeToken } from '$lib/spotify';
import { query } from '@neokit-dev/relational';
import { error } from '@sveltejs/kit';

export async function load({ url }) {
	const code = url.searchParams.get('code');
	if (!code) return error(401, 'Missing callback code\n<a href="/spotify#login">Try again</a>');

	const token = await codeToken(code);
	const api = createApi(token);

	try {
		const user = await api.currentUser.profile();

		const state = url.searchParams.get('state')?.split('/') as string[];
		const clientId = state[0].length > 0 ? state[0] : SPOTIFY_ID;
		const clientSecret = state[1].length > 0 ? state[1] : SPOTIFY_SECRET;

		try {
			await query(
				'INSERT INTO spotify (username, clientId, clientSecret, refreshToken) VALUES (?, ?, ?, ?)',
				user.id,
				clientId,
				clientSecret,
				token.refresh_token
			);
		} catch {
			await query(
				'UPDATE spotify SET clientId = ?, clientSecret = ?, refreshToken = ? WHERE username = ?',
				clientId,
				clientSecret,
				token.refresh_token,
				user.id
			);
		}

		return { ...user };
	} catch {
		const state = url.searchParams.get('state')?.split('/') as string[] ?? ['', ''];
		const clientId = state[0]?.length > 0 ? state[0] : '';
		const clientSecret = state[1]?.length > 0 ? state[1] : '';
		return error(403, `Invalid callback code\n<a href="/spotify/auth?${(new URLSearchParams({
			id: clientId,
			secret: clientSecret
		})).toString()}">Try again</a>`);
	}
}
