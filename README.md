# Additional README stats

Enhance your profile or repository README with these cool stats!

This project is compatible with and inspired by [Anurag Hazra](https://github.com/anuraghazra)'s [GitHub Readme Stats](https://github.com/anuraghazra/github-readme-stats) project.

**Note:** This project doesn't support gradients yet. Also, you cannot use the `width` parameter (and it will not be implemented soon).

## Platforms

- [Spotify](docs/spotify.md)

## Usage

Check out the platforms above to see how to use them.

If you don't want to self-host your own instance, you can use this one as your base URL: `https://armstats.leox.dev`

## Auto redirect

Some services (e. g. Spotify) want you to add a link to their service in your README. This project supports auto redirecting to the service's website.

You just have to modify the url like this:

`<endpoint URL>/html?<params>`

This allows you to link multiple URLs at once.

## Dynamic JSON Badges

This project supports [Shields.io](https://shields.io) Dynamic JSON Badges.

Visit the [Shields.io badge generator](https://shields.io/badges/dynamic-json-badge) and use the following URL as the URL input:

`<endpoint URL>/json?<params>`

For example, you can create badges like this:

![Spotify currently listening to](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Farmstats.leox.dev%2Fspotify%2Fcurrent%2Fjson%3Fusername%3Dji431f2ja6vyczqq0eatna6jb&query=%24.track&style=for-the-badge&logo=spotify&logoColor=%23ffffff&label=Currently%20listening%20to&labelColor=191414&color=1db954)

**Note:** Use the official service APIs for other purposes than README badges and your [personal website](#usage-on-your-personal-website).

## Usage on your personal website

All endpoints only support CORS for the following domains:

- ~~`*.github.io` (GitHub Pages domains)~~ `// TODO`

If you want to use this project on other websites, you have to fetch the data on your own server and then send it to the client.
It's recommended to cache the data for a few minutes.

You should use the same URL structure as [dynamic JSON badges](#dynamic-json-badges) because there are tools in almost every language to parse JSON.

**ONLY USE THIS ON YOUR PERSONAL WEBSITE! DO NOT USE THIS FOR OTHER (E.G. COMMERCIAL) PURPOSES!**

## Self hosting

If you want to host this project yourself, please read [the self hosting guide](docs/self-hosting.md).
