<script>
    import { onMount } from 'svelte';
    import Score from '../partials/Score.svelte';
    import Board from '../partials/Board.svelte';
    import StartButton from '../partials/StartButton.svelte';
    import Status from '../partials/Status.svelte';

    let score;
    let board;
    let status;

    onMount(async () => {
        score.setGamersHandler([{name: 'x', score: 0}, {name: '0', score: 0}]);
    });

    function increaseGamerScoreHandler(event) {
        score.increaseGamerScoreHandler(event.detail);
    }

    function gameStartedHandler(event) {
        board.renderBoardHandler();
    }
    function statusChangedHandler(event) {
        status.statusChangedHandler(event.detail.value);
    }
</script>

<div class="container h-100 m-lg-5 p-lg-5">
    <div class="row text-center">
        <div class="col">
            <Score bind:this={score}></Score>
        </div>
    </div>
    <div class="row align-items-center h-100">
        <div class="col d-flex justify-content-center">
            <div class="card text-center">
                <h5 class="card-header">SEA CHESS</h5>
                <div class="card-body">
                    <Board bind:this={board}
                           on:status_changed={statusChangedHandler}
                           on:increase_gamer_score={increaseGamerScoreHandler}
                    ></Board>
                    <StartButton on:game_started={gameStartedHandler}></StartButton>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <Status bind:this={status}></Status>
        </div>
    </div>
</div>
