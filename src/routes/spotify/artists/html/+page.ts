export async function load({ url, fetch }): Promise<{
  error: number | null;
  data: {
    artist: string;
    img: string;
    id: string;
  }[] | null;
  title: string;
  hideRank: boolean;
}> {
	const username = url.searchParams.get('username');
	if (!username) return {
    error: 400,
    data: null,
    title: '',
    hideRank: false
  };
  const limit = url.searchParams.has('limit') ? parseInt(url.searchParams.get('limit') as string) : 5;
  const period = url.searchParams.get('period');
  const title = url.searchParams.get('custom_title') ?? `My top artists of ${period === 'month' ? 'the last month' : period === 'halfyear' ? 'the last six months' : 'all time'}`;
  const hideRank = url.searchParams.has('hide_rank');

  return {
    ...(await (await fetch(`/spotify/artists/json?username=${username}&limit=${limit}&period=${period}`)).json()),
    title,
    hideRank
  };
}
