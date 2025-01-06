import { ROOT, SPOTIFY_ID } from '$env/static/private';
import { redirect } from '@sveltejs/kit';

export function GET({ url }) {
	const clientIdParam = url.searchParams.get('id');
	const clientSecretParam = url.searchParams.get('secret');
	return redirect(
		307,
		'https://accounts.spotify.com/authorize?' +
			new URLSearchParams({
				response_type: 'code',
				client_id: SPOTIFY_ID,
				scope:
					'user-top-read user-read-currently-playing user-read-playback-state user-read-recently-played',
				redirect_uri: ROOT + '/spotify/callback',
				state: clientIdParam && clientSecretParam ? `${clientIdParam}/${clientSecretParam}` : '/'
			}).toString()
	);
}
