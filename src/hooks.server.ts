import { type Handle } from '@sveltejs/kit';
import { init, load } from '@neokit-dev/core';
import { plugin as relational } from '@neokit-dev/relational';
import { plugin as d1 } from '@neokit-dev/d1';
import type { D1Database } from '@cloudflare/workers-types';

export const handle: Handle = async ({ event, resolve }) => {
	init();
	load(relational({}), d1({ db: event.platform?.env.armstatsDatabase as D1Database }));
	return resolve(event);
};
