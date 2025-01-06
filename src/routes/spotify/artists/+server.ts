import { dataUrl } from '$lib/download';
import { escapeHtml as e } from '$lib/escape';
import { getTop } from '$lib/spotify';
import { getTheme } from '$lib/themes';
import { error, text } from '@sveltejs/kit';

export async function GET({ url }) {
	try {
		const username = url.searchParams.get('username');
		if (!username) return error(400, 'No username provided');
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
		const limit = url.searchParams.has('limit')
			? parseInt(url.searchParams.get('limit') as string)
			: 5;

		const artists = await getTop('artists', time, username, limit);

		for (let i = 0; i < limit; i++) {
			artists[i].img = await dataUrl(artists[i].img);
		}

		const height = 60 + limit * 40;

		let logotype = 'icon';
		if (url.searchParams.get('logo') == 'logo') logotype = 'logo';

		let logocolor = 'black';
		const logocolorQuery = url.searchParams.get('logo_color') as string;
		if (logocolorQuery == 'white' || logocolorQuery == 'green') logocolor = logocolorQuery;

		let logoposy = 19;
		if (url.searchParams.get('logo_position') == 'bottom_right') logoposy = height - 40;

		const logo = await dataUrl(`https://cdn.le0x8.com/spotify/${logotype}s/${logocolor}.png`);

		const theme = getTheme(url);
		let titlePeriod = 'all time';
		switch (time) {
			case 'short_term':
				titlePeriod = 'the last month';
				break;
			case 'medium_term':
				titlePeriod = 'the last six months';
				break;
		}
		const title = theme.custom_title ?? 'My top artists of ' + titlePeriod;

		return text(
			`<svg width="350" height="${height}" viewBox="0 0 350 ${height}" fill="none" xmlns="http://www.w3.org/2000/svg" role="img">
    <title>${title}</title>
    <desc>${artists.map((artist, i) => `${i + 1}. ${e(artist.artist)}`).join('\n')}</desc>
    <style>
        .header {
            font: 600 15.5px 'Segoe UI', Ubuntu, sans-serif;
            fill: #${theme.title_color};
        }

        .name {
            transform: translate(60px, 0);
            font: 400 15px 'Segoe UI', Ubuntu, sans-serif;
            fill: #${theme.text_color};
        }

        .image {
            transform: translate(25px, 0);
            width: 27.5px;
            height: 27.5px;
        }

        .icon {
            width: 21px;
            height: 21px;
        }

        .logo {
            width: 70px;
            height: 21px;
        }

        .rank {
            transform: translate(8px, 0);
            font: 700 15px 'Segoe UI', Ubuntu, sans-serif;
            fill: #${url.searchParams.has('hide_rank') ? '00000000' : theme.icon_color};
        }
    </style>

    <defs>
        <rect id="rect0" x="0" y="48.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect1" x="0" y="88.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect2" x="0" y="128.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect3" x="0" y="168.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect4" x="0" y="208.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect5" x="0" y="248.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect6" x="0" y="288.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect7" x="0" y="328.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect8" x="0" y="368.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <rect id="rect9" x="0" y="408.75" width="27.5" height="27.5" rx="${theme.inner_border_radius}"/>
        <clipPath id="clip0">
            <use href="#rect0"/>
        </clipPath>
        <clipPath id="clip1">
            <use href="#rect1"/>
        </clipPath>
        <clipPath id="clip2">
            <use href="#rect2"/>
        </clipPath>
        <clipPath id="clip3">
            <use href="#rect3"/>
        </clipPath>
        <clipPath id="clip4">
            <use href="#rect4"/>
        </clipPath>
        <clipPath id="clip5">
            <use href="#rect5"/>
        </clipPath>
        <clipPath id="clip6">
            <use href="#rect6"/>
        </clipPath>
        <clipPath id="clip7">
            <use href="#rect7"/>
        </clipPath>
        <clipPath id="clip8">
            <use href="#rect8"/>
        </clipPath>
        <clipPath id="clip9">
            <use href="#rect9"/>
        </clipPath>
    </defs>
    <use href="#rect0" stroke-width="2" />
    <use href="#rect1" stroke-width="2" />
    <use href="#rect2" stroke-width="2" />
    <use href="#rect3" stroke-width="2" />
    <use href="#rect4" stroke-width="2" />
    <use href="#rect5" stroke-width="2" />
    <use href="#rect6" stroke-width="2" />
    <use href="#rect7" stroke-width="2" />
    <use href="#rect8" stroke-width="2" />
    <use href="#rect9" stroke-width="2" />

    <rect x="0.5" y="0.5" width="348" height="${height - 2}" fill="#${theme.bg_color}" stroke="#${theme.border_color}" rx="${theme.border_radius}" stroke-width="1" stroke-opacity="1"></rect>
    <text x="25" y="35" class="header">${title}</text>

    ${artists
			.map(
				(artist, i) => `
      <text y="${67.5 + i * 40}" x="${i > 8 ? -4 : 0}" class="rank">${i + 1}</text>
      <image href="${artist.img}" y="${48.75 + i * 40}" clip-path="url(#clip${i})" class="image"></image>
      <text y="${67.5 + i * 40}" class="name">${e(artist.artist)}</text>
      `
			)
			.join('\n')}
    
    ${logotype === 'icon' ? `<image href="${logo}" x="310" y="${logoposy}" class="icon"></image>` : `<image href="${logo}" x="260" y="${logoposy}" class="logo"></image>`}
</svg>`,
			{ headers: { 'Content-Type': 'image/svg+xml' } }
		);
	} catch {
		return text(
			`<svg width="467" height="195" viewBox="0 0 467 195" fill="#fff" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="descId">
    <title>Login Required</title>
    <desc id="You need to log in to use this image. See the docs for more info."></desc>
    <style>
        .header {
            font: 600 26px 'Segoe UI', Ubuntu, sans-serif;
            fill: #f00;
        }

        .text {
            font: 400 13px 'Segoe UI', Ubuntu, sans-serif;
            fill: #333;
        }
    </style>
    <rect x="0" y="0" width="467" height="195" fill="#fff"></rect>
    <text x="25" y="50" class="header" data-testid="header">Login required</text>
    <text x="25" y="75" class="text" data-testid="text">You need to log in to use this image. See the docs for more info.</text>
</svg>`,
			{ status: 401, headers: { 'Content-Type': 'image/svg+xml', 'Cache-Control': 'no-cache' } }
		);
	}
}
