<script lang="ts">
	import Card from './Card.svelte';

	const {
		artist,
		img,
		id,
		hideRank = false,
		rank
	}: {
		artist: string;
		img: string;
		id: string;
		hideRank: boolean;
		rank: number;
	} = $props();

	const showRank = !hideRank;
</script>

<Card
	target="https://open.spotify.com/artist/{id}"
	{img}
	alt={artist}
	{showRank}
	{rank}
	text={artist}
  imgRounded={true}
/>
