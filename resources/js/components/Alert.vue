<template>
    <div :class="style" role="alert">
        <span v-if="details.message">{{ details.message }}</span>
        <hr v-if="details.errors" />
        <br v-if="details.errors" />
        <ul v-if="details.errors">
            <li v-for="(e, key) in details.errors" :key="key">
                {{ e[0] }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ["details"],
    computed: {
        style() {
            return "alert alert-" + this.details.type;
        },
    },
};
</script>
