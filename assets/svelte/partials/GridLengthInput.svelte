<script>
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();

    let value = 3;
    let disabled = false;

    export const disableHandler = (data) => disable(data);

    function disable(data) {
        disabled = data.value;
    }

</script>

<input bind:value="{value}"
       on:click={() => dispatch('grid_length_changed', {value: value})}
       disabled='{disabled}'
       type="number"
       class="form-control w-25 float-start"
/>
