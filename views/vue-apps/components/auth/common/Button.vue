<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    text: String,
    className: String,
    iconClass: String,
    notBtn: Boolean, // Ensure this is a Boolean type
    type: {
        type: String,
        default: 'button'
    }
});

const emit = defineEmits(["handleClick"]);
const handleClick = () => {
    emit("handleClick");
}
</script>

<template>
    <template v-if="notBtn">
        <a class="btn" :class="className" @click="handleClick">
            <i class="icon" :class="iconClass"></i>
            {{ text }}
        </a>
    </template>
    <template v-else>
        <button :type="type" class="btn" :class="className" @click="handleClick">
            <i class="icon" :class="iconClass"></i>
            {{ text }}
        </button>
    </template>
</template>

