import { dataUrl } from '$lib/download';
import { escapeHtml as e } from '$lib/escape';
import { getCurrent } from '$lib/spotify';
import { getTheme } from '$lib/themes';
import { error, text } from '@sveltejs/kit';
import {
	CirclePlay,
	CirclePause,
	Shuffle,
	Repeat,
	Repeat1,
	VolumeX,
	Volume1,
	Volume2,
	LaptopMinimal,
	Smartphone,
	Speaker
} from 'lucide-static';

export async function GET({ url }) {
	try {
		const username = url.searchParams.get('username');
		if (!username) return error(400, 'No username provided');

		const current = await getCurrent(username);
		if (!current) return error(400, 'Not playing anything');

		current.img = await dataUrl(current.img);

		let logotype = 'icon';
		if (url.searchParams.get('logo') == 'logo') logotype = 'logo';

		let logocolor = 'black';
		const logocolorQuery = url.searchParams.get('logo_color') as string;
		if (logocolorQuery == 'white' || logocolorQuery == 'green') logocolor = logocolorQuery;

		let logoposy = 19;
		if (url.searchParams.get('logo_position') == 'bottom_right') logoposy = 310;

		const logo = await dataUrl(`https://cdn.le0x8.com/spotify/${logotype}s/${logocolor}.png`);

		const theme = getTheme(url);
		const title = theme.custom_title ?? 'My current Spotify track';

		return text(
			`<svg width="350" height="350" viewBox="0 0 350 350" fill="none" xmlns="http://www.w3.org/2000/svg" role="img">
    <title>${title}</title>
    <desc></desc>
    <style>
        .header {
            font: 600 15.5px 'Segoe UI', Ubuntu, sans-serif;
            fill: #${theme.title_color};
        }

        .name {
            font: 400 20px 'Segoe UI', Ubuntu, sans-serif;
            font-weight: 400;
            font-family: 'Segoe UI', Ubuntu, sans-serif;
            fill: #${theme.text_color};
        }

        .artist {
            font: 400 17.5px 'Segoe UI', Ubuntu, sans-serif;
            fill: #${theme.icon_color};
        }

        .image {
            width: 150px;
            height: 150px;
        }

        .icon {
            width: 21px;
            height: 21px;
        }

        .logo {
            width: 70px;
            height: 21px;
        }

        .vertical {
            writing-mode: vertical-lr;
            transform: translate(42.5px, 422.5px) rotate(180deg);
            font-family: 'Segoe UI', Ubuntu, sans-serif;
            font-variant: small-caps;
        }
    </style>

    <defs>
        <rect id="rect" x="100" y="60" width="150" height="150" rx="${theme.inner_border_radius}"/>
        <clipPath id="clip">
            <use href="#rect"/>
        </clipPath>
    </defs>
    <use href="#rect" stroke-width="2" />

    <rect x="0.5" y="0.5" width="348" height="348" fill="#${theme.bg_color}" stroke="#${theme.border_color}" rx="${theme.border_radius}" stroke-width="1" stroke-opacity="1"></rect>
    <text x="25" y="35" class="header">${title}</text>

    <text class="name" x="50%" y="275" dominant-baseline="middle" text-anchor="middle">${e(current.track)}</text>
    <text class="artist" x="50%" y="300" dominant-baseline="middle" text-anchor="middle">${e(current.artist)}</text>
    <image href="${e(current.img)}" x="100" y="60" class="image" clip-path="url(#clip)" />

    <image href="data:image/svg+xml;base64,${btoa((current.playing ? CirclePlay : CirclePause).replace('stroke="currentColor"', `stroke="#${theme.icon_color}"`))}" x="155" y="217.5" width="40" height="40" />
    <image href="data:image/svg+xml;base64,${btoa(Shuffle.replace('stroke="currentColor"', `stroke="#${theme.icon_color}"`))}" x="110" y="222.5" width="30" height="30" opacity="${current.shuffle ? 1 : 0.25}" />
    <image href="data:image/svg+xml;base64,${btoa((current.repeat == 'track' ? Repeat1 : Repeat).replace('stroke="currentColor"', `stroke="#${theme.icon_color}"`))}" x="210" y="222.5" width="30" height="30" opacity="${current.repeat != 'off' ? 1 : 0.25}" />
    
    ${
			theme.show.volume
				? `<rect x="317.5" y="60" width="10" height="150" fill="#${theme.inner_bg_color}" rx="${theme.inner_border_radius}"></rect>
        <rect x="317.5" y="${210 - current.volume * 1.5}" width="10" height="${current.volume * 1.5}" fill="#${theme.icon_color}" rx="${theme.inner_border_radius}"></rect>
        <image href="data:image/svg+xml;base64,${btoa((current.volume == 0 ? VolumeX : current.volume > 50 ? Volume2 : Volume1).replace('stroke="currentColor"', `stroke="#${theme.icon_color}"`))}" x="310" y="225" width="25" height="25"></image>`
				: ''
		}
    ${
			theme.show.device
				? `<text x="15" y="210" font-size="25" fill="#${theme.icon_color}" class="vertical">${e(current.device)}</text>
        <image href="data:image/svg+xml;base64,${btoa((current.deviceType == 'smartphone' ? Smartphone : current.deviceType == 'computer' ? LaptopMinimal : Speaker).replace('stroke="currentColor"', `stroke="#${theme.icon_color}"`))}" x="15" y="225" width="25" height="25"></image>`
				: ''
		}

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
			{ status: 401, headers: { 'Content-Type': 'image/svg+xml' } }
		);
	}
}
