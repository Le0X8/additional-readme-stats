import { DB_INITIALIZATION_KEY } from '$env/static/private';
import { query } from '@neokit-dev/relational';
import { json } from '@sveltejs/kit';

export async function GET({ url }) {
	const key = url.searchParams.get('initKey');
	if (key === 'disabled' || key !== DB_INITIALIZATION_KEY)
		return json({ error: 'Forbidden', success: false }, { status: 403 });

	const database: Record<string, Record<string, string>> = {
		spotify: {
			username: 'VARCHAR(255) PRIMARY KEY',
			clientId: 'VARCHAR(32)',
			clientSecret: 'VARCHAR(32)',
			refreshToken: 'VARCHAR(255)'
		},
		spotifyRecentTracks: {
			username: 'VARCHAR(255) PRIMARY KEY',
			track$10: 'VARCHAR(255)',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyCurrentTrack: {
			username: 'VARCHAR(255) PRIMARY KEY',
			device: 'VARCHAR(255)',
			device_type: 'VARCHAR(255)',
			volume: 'INT UNSIGNED',
			shuffle: 'BOOLEAN',
			repeat: 'VARCHAR(255)',
			playing: 'BOOLEAN',
			playtype: 'VARCHAR(31)',
			track: 'VARCHAR(255)',
			artist: 'VARCHAR(255)',
			img: 'VARCHAR(255)',
			id: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyTopTracksMonth: {
			username: 'VARCHAR(255) PRIMARY KEY',
			track$10: 'VARCHAR(255)',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyTopTracksHalfYear: {
			username: 'VARCHAR(255) PRIMARY KEY',
			track$10: 'VARCHAR(255)',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyTopTracksAllTime: {
			username: 'VARCHAR(255) PRIMARY KEY',
			track$10: 'VARCHAR(255)',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyTopArtistsMonth: {
			username: 'VARCHAR(255) PRIMARY KEY',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyTopArtistsHalfYear: {
			username: 'VARCHAR(255) PRIMARY KEY',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		},
		spotifyTopArtistsAllTime: {
			username: 'VARCHAR(255) PRIMARY KEY',
			artist$10: 'VARCHAR(255)',
			img$10: 'VARCHAR(255)',
			id$10: 'VARCHAR(63)',
			expiration_time: 'INT UNSIGNED'
		}
	};

	const tables = Object.keys(database);

	const queries = [];

	for (const i in tables) {
		const table = tables[i];
		const cols = Object.keys(database[table])
			.map((col) => {
				const [colName, timesStr] = col.split('$');
				const times = timesStr ? parseInt(timesStr) : 1;

				if (times === 1) return `${colName} ${database[table][col]}`;

				const cols = [];
				for (let i = 0; i < times; i++) cols.push(`${colName}${i} ${database[table][col]}`);
				return cols.join(', ');
			})
			.join(', ');

		queries.push(`CREATE TABLE IF NOT EXISTS ${table} (${cols})`);
	}

	await query(queries.join('; '));

	return json({ error: null, success: true }, { status: 201 });
}
