<script setup>
import { onMounted, ref } from 'vue';

const show = ref(true);

onMounted(() => {
    setTimeout(() => {
        show.value = false;
    }, 1200); // durée courte et élégante
});
</script>
<template>
    <div v-if="show" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white dark:bg-[var(--dark-background)]">
        <!-- Texte -->
        <p
            aria-live="polite"
            role="status"
            class="mb-4 text-[clamp(10px,2.5vw,14px)] font-medium tracking-[0.3em] text-[var(--primary-blue)] uppercase dark:text-[var(--dark-gold)]"
        >
            CHARGEMENT…
        </p>

        <!-- Ligne moderne -->
        <div class="relative h-[2px] w-40 overflow-hidden bg-gray-200 dark:bg-gray-700">
            <span class="loading-line absolute top-0 left-0 h-full w-1/3 bg-[var(--primary-blue)] dark:bg-[var(--dark-gold)]"></span>
        </div>
    </div>
</template>
<style scoped>
.loading-line {
    animation: loading 1.5s ease-in-out infinite;
}

@keyframes loading {
    0% {
        left: -100%;
    }
    100% {
        left: 100%;
    }
}
.loading-line {
    animation: loading 1.3s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}
</style>
