<template>
    <table data-vue="" class="table">
        <thead>
        <tr>
            <th
                v-for="index in Array(MAX_FRAMES).keys()"
                scope="col"
                :key="index + 1"
                class="text-right"
            >
                {{ index + 1 }}
            </th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td
                v-for="(roll, index) in rolls"
                :key="index"
                class="py-0"
            >
                <div
                    class="row text-center"
                >
                    <div>
                        <!-- frame score -->
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                {{ rolls }}
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script lang="ts" src="./FramesTable.ts"></script>

<style scoped>

</style>