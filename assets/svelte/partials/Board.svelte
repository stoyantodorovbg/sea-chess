<script>
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();

    let gridLength = 3;
    let grid = [];
    let hits = {x: 0, 0: 0};
    let allHits = 0;
    let turn = 'x';
    let gameScore = {x: 0, 0: 0};
    let disabled = false;

    export const renderBoardHandler = () => renderBoard();
    export const gridLengthChangedHandler = (data) => gridLengthChanged(data);

    function renderBoard() {
        newGrid();
        dispatch('status_changed', { value: 'Game started' })
    }

    function gridLengthChanged(data) {
        gridLength = data.value;
    }

    function newGrid() {
        grid = [];
        disabled = false;
        gameScore = {x: 0, 0: 0};
        allHits = 0;
        for (let i = 0; i < gridLength; i++) {
            let row = [];
            for (let i = 0; i < gridLength; i++) {
                row.push('1');
            }
            grid.push(row);
        }
        dispatch('gamers_initialized', {x: 0, 0: 0});
    }

    function hit(row, col) {
        if (grid[row][col] !== '1' || disabled) {
            return;
        }
        grid[row][col] = turn;
        hits[turn]++;
        if (checkWin(turn) !== false) {
            disabled = true;
            dispatch('increase_gamer_score', {name: turn, 'score': 1});
            dispatch('status_changed', {value: turn + ' won'});

            return;
        }

        turn = turn === 'x' ? '0' : 'x';
        allHits++;
        if (allHits === gridLength * gridLength) {
            disabled = true;
            dispatch('status_changed', { value: 'Draw' });
        }

    }

    function checkWin() {
        if (hits.x >= gridLength || hits[0] >= gridLength) {
            for (let i1 = 0; i1 < gridLength; i1++) {
                for (let i2 = 0; i2 < gridLength; i2++) {
                    let check = checkCompleted(grid[i1][i2]);
                    if (check !== false) {
                        return check;
                    }
                }
                resetScore();
                for (let i2 = 0; i2 < gridLength; i2++) {
                    let check = checkCompleted(grid[i2][i1]);
                    if (check !== false) {
                        return check;
                    }
                }
                resetScore();
            }

            let col = 0;
            for (let row = 0; row < gridLength; row++) {
                if (col === row) {
                    let check = checkCompleted(grid[row][col]);
                    if (check !== false) {
                        return check;
                    }
                }
                col++;
            }
            resetScore();
            col = 0;
            for (let row = gridLength - 1; row >= 0; row--) {
                if (col + row === gridLength - 1 || col === row) {
                    let check = checkCompleted(grid[row][col]);
                    if (check !== false) {
                        return check;
                    }
                }
                col++;
            }
            resetScore();
        }

        return false;
    }

    function checkCompleted(cell) {
        if (cell !== '1') {
            gameScore[cell]++;
        }
        if (gameScore.x === gridLength) {
            return 'x';
        }
        if (gameScore[0] === gridLength) {
            return '0';
        }
        return false;
    }

    function resetScore() {
        gameScore = {x: 0, 0: 0};
    }
</script>

<div>
    <table class="table table-bordered"
           style="opacity: {disabled ? '0.5' : '1'}; pointer-events: {disabled ? 'none' : 'all'};"
    >
        <tbody>
            {#each grid as cols, row (row)}
                <tr>
                    {#each cols as value, col (col)}
                        <td on:click={hit(row, col)} class="cell p-lg-5">
                            <span class="{value === '1' ? 'text-white' : ''}">{value}</span>
                        </td>
                    {/each}
                </tr>
            {/each}
        </tbody>
    </table>
</div>

<style>
    .cell {
        min-width: 125px;
        cursor: pointer;
    }
</style>