<script>
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();
</script>

<button on:click={() => dispatch('game_started')} class="btn btn-primary float-end">
    Start New Game
</button>
