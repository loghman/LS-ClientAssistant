<script setup>
import { defineProps, defineEmits } from "vue";
const props = defineProps({
    text: String,
    nextStep: String,
});
const emit = defineEmits(["onclick"]);
const onclick = () => {
    emit("onclick");
};
</script>

<template>
    <button
        type="button"
        class="btn-primary w-100 btn-submit"
        :onclick="onclick"
    >
        <span>{{ text }}</span
        ><i class="si-arrow-left-r"></i>
    </button>
</template>
