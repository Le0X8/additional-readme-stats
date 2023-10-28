# Spotify Stats

## Authentication

To authenticate with Spotify, you need to create a Spotify application [here](https://developer.spotify.com/dashboard/create) and setting the redirect URI to `<protocol>://<your domain>/spotify/callback/<your client_id>/<your client_secret>`. If the instance you are using is providing a custom API key, you can leave the Client ID and Client Secret fields empty. This can be checked by visiting the `/configuration` endpoint.

### Parameters

| Parameter | Description | Default value | Required |
| --- | --- | --- | --- |
| `client_id` | Your Spotify application client ID | empty string | Yes/No |
| `client_secret` | Your Spotify application client secret ([encrypted](../README.md#key-encryption)) | empty string | Yes/No |
| `username` | Your Spotify username | empty string | Yes |

**Note:** `client_id` and `client_secret` are only required at login.

### Login

Endpoint: `/spotify/auth`

You just have to visit this URL once, remeber to add `client_id` and `client_secret` if required.

**Note:**
You need to be logged in to your Spotify account in your browser for this to work.

## Caching

After being logged out after 1 hour, all data will stay cached for 14 days. This means that you can still access your stats without being logged in. After 14 days, all data will be deleted and you will need to log in again.

**Note:** Cached data is not real-time.

## Stats

### Recently played tracks

Endpoint: `/spotify/recents`
