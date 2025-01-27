<script lang="ts">
  import Card from './Card.svelte';

	const {
    track,
		artist,
		img,
		id,
		rank
	}: {
    track: string;
		artist: string;
		img: string;
		id: string;
		rank: number;
	} = $props();
</script>

<Card
	target="https://open.spotify.com/track/{id}"
	{img}
	alt={track}
	showRank={false}
	{rank}
	text={track}
  text2={artist}
/>
