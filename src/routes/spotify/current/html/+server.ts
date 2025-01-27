import { getCurrent } from '$lib/spotify';
import { redirect, json } from '@sveltejs/kit';

export async function GET({ url }) {
	const username = url.searchParams.get('username');
	if (!username) return json({ error: 'No username provided', data: null }, { status: 400 });

	return redirect(307, 'https://open.spotify.com/track/' + (await getCurrent(username, true) as { id: string }).id);
}
