import { redirect } from '@sveltejs/kit';

export function GET() {
	return redirect(
		301,
		'https://github.com/Le0X8/additional-readme-stats/tree/main/docs/spotify.md'
	);
}
