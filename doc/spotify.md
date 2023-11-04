# Spotify Stats

## Note

All of these endpoints can be used as direct links to Spotify by just adding `/html` to the end of the endpoint URL.

## Common parameters

| Parameter | Description | Default value | Required |
| --- | --- | --- | --- |
| `logo` | The Spotify logo type ([`icon` or `logo`](#whats-the-difference-between-the-icon-and-logo-logo-types)) | `icon` | No |
| `logo_color` | The Spotify logo color (`black`, `white`, or `green`) [[TOS](#spotify-terms-of-service)] | `black` | No |
| `logo_position` | The Spotify logo position (`top_right` or `bottom_right`)  | `top_right` | No |

These can be used in all of the stats below.

## Stats

### Currently playing track

Endpoint: `/spotify/current`

Caching: 2 minutes

#### Example

```https://armstats.leox.dev/spotify/current?username=ji431f2ja6vyczqq0eatna6jb```

#### Parameters

| Parameter | Description | Default value | Required |
| --- | --- | --- | --- |
| `username` | Your Spotify username | empty string | Yes |
| `show` | What to show, valid: `volume`, `device` | empty string | No |

### Recently played tracks

Endpoint: `/spotify/recents`

Caching: 5 minutes

#### Example

```https://armstats.leox.dev/spotify/recents?username=ji431f2ja6vyczqq0eatna6jb```

![My recently played tracks](https://armstats.leox.dev/spotify/recents?username=ji431f2ja6vyczqq0eatna6jb)

#### Parameters

| Parameter | Description | Default value | Required |
| --- | --- | --- | --- |
| `username` | Your Spotify username | empty string | Yes |
| `limit` | The amount of tracks to show (between 1 and 10) | `5` | No |

## Authentication

To authenticate with Spotify, you need to create a Spotify application [here](https://developer.spotify.com/dashboard/create) and setting the redirect URI to `<protocol>://<your domain>/spotify/callback/<your client_id>/<your client_secret>`. If the instance you are using is providing a custom API key, you can leave the Client ID and Client Secret fields empty. This can be checked by visiting the `/configuration` endpoint.

### Parameters

| Parameter | Description | Default value | Required |
| --- | --- | --- | --- |
| `client_id` | Your Spotify application client ID | empty string | Yes/No |
| `client_secret` | Your Spotify application client secret | empty string | Yes/No |
| `username` | Your Spotify username | empty string | Yes |

### Login

Endpoint: `/spotify/auth`

You just have to visit this URL once, remeber to add `client_id` and `client_secret` if required.

**Note:**
You need to be logged in to your Spotify account in your browser for this to work.

## What's the difference between the `icon` and `logo` logo types?

| `icon` | ![Spotify icon](../assets/spotify/icons/green.png) |
| --- | --- |
| `logo` | ![Spotify logo](../assets/spotify/logos/green.png) |

## Spotify Terms of Service

To be compliant with the Spotify Terms of Service, you need to:

- make the Spotify logo only green if the background is black or white
- make the Spotify logo visible (DON'T USE WHITE ON WHITE, BLACK ON BLACK AND GREEN ON GREEN)

[Spotify's Design Guidelines](https://developer.spotify.com/documentation/design)

## General notes

All the data is fetched from the official Spotify API.

The copyright owner of the obtained data is Spotify AB and its partners.
