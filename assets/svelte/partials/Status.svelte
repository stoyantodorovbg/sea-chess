<script>
    let content = '';
    let type = 'text-success';

    export const statusChangedHandler = (value) => changeStatus(value);

    function changeStatus(value) {
        content = value;
    }
</script>

<p class="{type}">{content}</p>
