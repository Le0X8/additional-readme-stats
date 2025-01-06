<script lang="ts">
	export let data;
</script>

<div class="flex h-fit min-h-lvh w-full flex-col items-center justify-center">
	<img src={data.images[0].url} alt={data.display_name} class="h-48 rounded-full" />
	<h1 class="my-6 text-5xl font-bold">Hello, {data.display_name}!</h1>
	<p class="text-xl">You are now logged in.</p>
	<button
		onclick={() => {
			const target = document.getElementById('id') as HTMLInputElement;
			target.select();
			target.setSelectionRange(0, 256);
			navigator.clipboard.writeText(target.value);
			(document.getElementById('ctc') as HTMLParagraphElement).innerText = 'copied!';
			setTimeout(() => {
				(document.getElementById('ctc') as HTMLParagraphElement).innerText = 'click to copy';
			}, 1000);
		}}
		class="my-6"
	>
		<p class="my-1">Your user ID is:</p>
		<input
			type="text"
			value={data.id}
			id="id"
			readonly
			class="w-96 cursor-pointer rounded-lg border-2 border-slate-400 bg-transparent text-center font-mono"
		/>
		<p id="ctc" class="my-1 text-xs uppercase text-slate-400">click to copy</p>
	</button>
</div>
