<script setup>
import { ref } from "vue";

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

// Define a ref to hold the button or link element
const buttonRef = ref(null);

// Expose the ref to the parent
defineExpose({
  buttonRef,
});
</script>

<template>
    <template v-if="notBtn" ref="buttonRef">
        <a class="btn" :class="className" @click="handleClick">
            <i class="icon" :class="iconClass"></i>
            {{ text }}
        </a>
    </template>
    <template v-else>
        <button :type="type" ref="buttonRef" class="btn" :class="className" @click="handleClick">
            <i class="icon" :class="iconClass"></i>
            {{ text }}
        </button>
    </template>
</template>

