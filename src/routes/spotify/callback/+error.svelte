<script lang="ts">
  import { page } from '$app/state';

  const status = page.status;
  const errMsg = page.error?.message.split('\n') as string[];
  const error = errMsg[0];
  const description = errMsg[1];
</script>

<div>
  <h1>{status}</h1>
  <h2>{error}</h2>
  <p>{@html description}</p>
</div>