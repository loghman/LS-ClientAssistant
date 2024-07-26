<script setup>
import { defineProps } from "vue";


const props = defineProps({
    text: String,
    className: String,
    iconClass: String
});



</script>

<template>
    <label class="card-label fs-14">
        <button class="btn btn-circle"><i class="icon" :class="iconClass"></i></button>
        <span class="text">
            {{ text }}
        </span>
    </label>
</template>
