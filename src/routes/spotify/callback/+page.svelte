<script lang="ts">
	export let data;
</script>

<div>
	<img src={data.images[0].url} alt={data.display_name} />
	<h1>Hello, {data.display_name}!</h1>
	<p>You are now logged in.</p>
	<button
		onclick={() => {
			const target = document.getElementById('id') as HTMLInputElement;
			target.select();
			target.setSelectionRange(0, 256);
			navigator.clipboard.writeText(target.value);
			(document.getElementById('ctc') as HTMLParagraphElement).innerText = 'copied!';
		}}
	>
		<p>Your user ID is:</p>
		<input type="text" value={data.id} id="id" readonly />
		<p id="ctc">click to copy</p>
	</button>
</div>