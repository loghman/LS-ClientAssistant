
<script setup >
const props=defineProps({
    title:{
        default:"موبایل یا ایمیل خود را وارد کنید",
        String
    },
    iconClass:String
})

</script>
<template>
    <i v-if="iconClass" class="icon" :class="iconClass"></i>
    <h3 class="title auth-title">{{ title }}</h3>
</template>