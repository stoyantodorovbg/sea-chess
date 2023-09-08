<script>
    import axios from 'axios';

    export let userScores = [];

    export const updateUserScoresHandler = (data) => updateUserScores(data);

    async function updateUserScores(data) {
        try {
            let response = await axios.post('http://127.0.0.1:8000/api/set-score', {
                type: 'single player game',
                value: data.score
            });
        } catch (err) {
            console.log(err);
        }
    }
</script>

<div>
    <h4>Scores</h4>
    {#each userScores as score, index (index)}
        <div class="text-start">
            {score.type}: <span class="border-5">{score.value}</span>
        </div>
        <div class="text-start mb-2">
            started at: <span class="border-5">{score.createdAt}</span>
        </div>
    {/each}
</div>