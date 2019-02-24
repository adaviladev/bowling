<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component with {{ message }} and a size of {{ size / bar }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import GameList from './GameList'
    export default GameList;
</script>

<style>
    .card-body {
        color: #0074d9;
    }
</style>
