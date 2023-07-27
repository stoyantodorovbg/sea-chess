<script>
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();
</script>

<button class="btn btn-primary" on:click={() => dispatch('game_started')}>Start New Game</button>
