<template>
    <section class="flex flex-col items-center justify-center space-y-6 bg-[#FFFFFF] p-4 dark:bg-[var(--dark-background)]">
        <h4 class="text-center text-2xl font-bold">Radar technologique Boris Tech</h4>
        <div class="relative h-96 w-96 md:h-112 md:w-112">
            <!-- Cercles de fond animés (radar) -->
            <div
                v-for="i in 3"
                :key="'circle-' + i"
                class="absolute inset-0 rounded-full border border-[#223CB9] opacity-30 dark:border-[#F7DF1C]"
                :style="{ animation: `pulse-circle 6s ease-in-out ${i * 2}s infinite` }"
            ></div>

            <!-- Logo central -->
            <div class="absolute top-1/2 left-1/2 z-10 -translate-x-1/2 -translate-y-1/2 transform">
                <img src="/assets/boristech.jpg" alt="Boris Tech" class="h-28 w-28 rounded-full shadow-lg" />
            </div>

            <!-- Cercle des icônes -->
            <div class="animate-spin-slow absolute top-1/2 left-1/2 h-full w-full -translate-x-1/2 -translate-y-1/2 transform">
                <div
                    v-for="(icon, index) in deviceIcons"
                    :key="index"
                    class="absolute text-3xl text-gray-700 md:text-4xl"
                    :style="getIconStyle(index)"
                >
                    {{ icon }}
                </div>
            </div>

            <!-- Cercles ping qui partent du centre -->
            <div
                v-for="i in 3"
                :key="'ping-' + i"
                class="animate-ping-circle absolute top-1/2 left-1/2 h-3 w-3 rounded-full border-2 border-teal-400 opacity-50 md:h-4 md:w-4"
                :style="{ animationDelay: `${i * 1.5}s` }"
            ></div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const deviceIcons = ref(
    // ['💻', '🖥️', '📱', '🖨️', '🎮', '🎧', '⌚', '📡', '🖱️', '🎤', '📷', '📺', '💡', '🔌']

    ['💻', '🖥️', '📱', '🎒', '💽', '💾', '🧩', '🛠️', '📦', '💡', '🖱️', '⌨️', '🎧', '🔌'],
);

// Position des icônes autour du cercle
const getIconStyle = (index) => {
    const total = deviceIcons.value.length;
    const angle = (index / total) * 2 * Math.PI;
    const radius = 140; // distance du centre
    const x = Math.cos(angle) * radius;
    const y = Math.sin(angle) * radius;

    return {
        left: '50%',
        top: '50%',
        transform: `translate(${x}px, ${y}px) translate(-50%, -50%)`,
    };
};
</script>

<style scoped>
section {
    overflow: hidden;
}
/* Rotation globale pour icônes */
@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
.animate-spin-slow {
    animation: spin-slow 25s linear infinite;
}

/* Cercles de fond qui pulsent doucement */
@keyframes pulse-circle {
    0% {
        transform: scale(0.8);
        opacity: 0.3;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.1;
    }
    100% {
        transform: scale(0.8);
        opacity: 0.3;
    }
}

/* Cercles ping qui partent du centre et se propagent */
@keyframes ping-circle {
    0% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 0.6;
    }
    80% {
        transform: translate(-50%, -50%) scale(1.8);
        opacity: 0.1;
    }
    100% {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
}
.animate-ping-circle {
    animation: ping-circle 4s ease-out infinite;
}
</style>
