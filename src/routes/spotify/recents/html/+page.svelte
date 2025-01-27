<script lang="ts">
	import TrackCard from '$c/TrackCard.svelte';

	const { data } = $props();
	const tracks = data.data;
	const { error, title } = data;
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<main class="prose mx-auto px-4 md:px-0 dark:prose-invert">
	{#if error || !tracks}
		<h1>{error}</h1>
	{:else}
		<h1 class="my-12 text-center">{title}</h1>
		<div class="flex flex-col gap-4">
			{#each tracks as { track, artist, img, id }, rank}
				<TrackCard {track} {artist} {img} {id} {rank} />
			{/each}
		</div>
	{/if}

  <p class="text-center mb-3 text-sm">
    All data is obtained from the official Spotify API.
    <br/>
    This project is not related to Spotify AB or any of its partners in any way.
  </p>
</main>
