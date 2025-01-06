<script lang="ts">
	import { page } from '$app/state';

	const status = page.status;
	const errMsg = page.error?.message.split('\n') as string[];
	const error = errMsg[0];
	const description = errMsg[1];
</script>

<svelte:head>
	<title>{status}</title>
	<meta name="description" content={error} />
</svelte:head>

<div class="flex h-fit min-h-lvh w-full flex-col items-center justify-center">
	<h1 class="mb-6 text-5xl font-bold">{status}</h1>
	<h2 class="text-2xl">{error}</h2>
	{#if description}
		<p class="prose mt-6 dark:prose-invert">{@html description}</p>
	{/if}
</div>
