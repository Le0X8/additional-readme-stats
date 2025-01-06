import { getRecents } from '$lib/spotify';
import { json } from '@sveltejs/kit';

export async function GET({ url }) {
	const username = url.searchParams.get('username');
	if (!username) return json({ error: 'No username provided', data: null }, { status: 400 });
	const limit = url.searchParams.get('limit');

	return json({
		error: null,
		data: await getRecents(username, limit ? parseInt(limit) : undefined)
	});
}
