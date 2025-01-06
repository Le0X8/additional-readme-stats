export async function dataUrl(url: string) {
	const blob = await (await fetch(url)).blob();
	return `data:${blob.type};base64,${arrayBufferToBase64(await blob.arrayBuffer())}`;
}

function arrayBufferToBase64(buffer: ArrayBuffer) {
	let binary = '';
	const bytes = new Uint8Array(buffer);
	for (let i = 0; i < bytes.byteLength; i++) {
		binary += String.fromCharCode(bytes[i]);
	}
	return btoa(binary);
}
