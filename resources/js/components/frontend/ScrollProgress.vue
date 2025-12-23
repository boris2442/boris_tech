<template>
    <div class="fixed top-0 left-0 z-[9999] h-1 bg-[var(--dark-gold)] transition-all duration-75" :style="{ width: progress + '%' }"></div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue';

const progress = ref(0);

const updateProgress = () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;

    if (docHeight > 0) {
        progress.value = (scrollTop / docHeight) * 100;
    }
};
onMounted(() => window.addEventListener('scroll', updateProgress));
onUnmounted(() => window.removeEventListener('scroll', updateProgress));
</script>
