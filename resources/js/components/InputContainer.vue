<template>
    <div class="form-group">
        <label :for="id" class="form-label">{{ label }}</label>
        <slot name="content"></slot>
        <div id="idHelp" class="form-text">{{ helpText }}</div>
    </div>
</template>

<script>
export default {
    props: ["id", "label", "type", "help", "helpText", "placeholder"],
};
</script>
