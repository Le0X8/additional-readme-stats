import { getTop } from '$lib/spotify';
import { json } from '@sveltejs/kit';

export async function GET({ url }) {
	const username = url.searchParams.get('username');
	if (!username) return json({ error: 'No username provided', data: null }, { status: 400 });
	const period = url.searchParams.get('period');
	let time: 'short_term' | 'medium_term' | 'long_term';
	switch (period) {
		case 'month':
			time = 'short_term';
			break;
		case 'halfyear':
			time = 'medium_term';
			break;
		default:
			time = 'long_term';
	}
	const limit = url.searchParams.get('limit');

	return json({
		error: null,
		data: await getTop('artists', time, username, limit ? parseInt(limit) : undefined)
	});
}
