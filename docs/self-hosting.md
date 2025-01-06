# Self hosting

If you want to self host this project, please read the following instructions.

## Requirements

- a Cloudflare account

## Installation

Fork this repository and add it as a Cloudflare Pages website with SvelteKit presets. You'll need to edit `wrangler.toml` to include your own Cloudflare D1 database id.

### Keys

You need to specify your own keys. Provide them using the Cloudflare dashboard. You can find all required keys in [`default.env`](../default.env).

#### Database setup

1. Specify a custom init key in your environment variables.
2. Go to your browser and navigate to `https://<your domain>/init?initKey=<your init key>`.
3. Set the init key to an empty string to disable the init route.

#### Spotify

1. Create a new Spotify application [here](https://developer.spotify.com/dashboard/create);
2. Set redirect URI to `https://<your domain>/spotify/callback`;
3. After creating the application, go to settings and copy the client ID and client secret.
4. Fill in the keys in your environment variables.

**Note:**
If you are in development mode, you have to add yourself and everyone who can use the same credentials as you in the `User Management` tab in your application dashboard.
