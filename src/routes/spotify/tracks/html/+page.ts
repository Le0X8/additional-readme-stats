export async function load({ url, fetch }): Promise<{
  error: number | null;
  data: {
    track: string;
    artist: string;
    img: string;
    id: string;
  }[] | null;
  title: string;
}> {
	const username = url.searchParams.get('username');
	if (!username) return {
    error: 400,
    data: null,
    title: ''
  };
  const limit = url.searchParams.has('limit') ? parseInt(url.searchParams.get('limit') as string) : 5;
  const period = url.searchParams.get('period');
  const title = url.searchParams.get('custom_title') ?? `My top tracks of ${period === 'month' ? 'the last month' : period === 'halfyear' ? 'the last six months' : 'all time'}`;
  
  return {
    ...(await (await fetch(`/spotify/tracks/json?username=${username}&limit=${limit}&period=${period}`)).json()),
    title
  };
}
