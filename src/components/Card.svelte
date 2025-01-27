<script lang="ts">
	const {
		target,
		img,
		alt,
		showRank = false,
		rank,
		text,
		text2 = undefined,
    imgRounded = false,
	}: {
		target: string;
		img: string;
		alt: string;
		showRank: boolean;
		rank: number;
		text: string;
		text2?: string;
    imgRounded?: boolean;
	} = $props();
</script>

<a
	href={target}
	class={`not-prose group flex h-24 overflow-hidden rounded-lg border ${imgRounded ? 'p-3' : ''} pr-0 transition md:hover:scale-105 select-none`}
>
	<img src={img} {alt} class={imgRounded ? 'rounded-full': ''} />
	{#if showRank}
		<h3 class="flex h-full w-12 items-center justify-center p-4">
			{rank + 1}
		</h3>
	{/if}
	<div class={`flex flex-col h-full grow justify-center px-4 ${imgRounded ? '' : 'py-3'} ${showRank ? 'pl-0' : ''} text-2xl font-semibold overflow-hidden`}>
		<h2
			class="underline decoration-transparent transition group-hover:decoration-current md:group-hover:decoration-transparent text-ellipsis w-full whitespace-nowrap overflow-hidden"
		>
			{text}
		</h2>
    {#if text2}
      <p class="text-lg font-normal text-ellipsis w-full whitespace-nowrap overflow-hidden">{text2}</p>
    {/if}
	</div>
</a>
