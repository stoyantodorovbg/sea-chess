<script>
    let gamers = []

    export const setGamersHandler = (data) => setGamers(data);
    export const increaseGamerScoreHandler = (data) => increaseGamerScore(data);

    function setGamers(data) {
        gamers = data;
    }

    function increaseGamerScore(data) {
        let gamer = gamers.find(gamer => gamer.name === data.name);
        gamer.score++;
        gamers = gamers;
    }
</script>

<div>
    {#each gamers as gamer, index (index)}
        <div class="text-start">{gamer.name}: <span class="border-5">{gamer.score}</span></div>
    {/each}
</div>