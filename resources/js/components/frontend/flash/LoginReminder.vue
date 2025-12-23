<script setup>
import { router } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

const showOverlay = ref(false);
const currentMessage = ref('');

// ✅ Messages aléatoires
const messages = [
    '💫 Bienvenue sur Boris Tech !',
    '🚀 Découvre nos nouveautés du jour !',
    '✨ Connecte-toi pour profiter de toutes les fonctionnalités !',
    '🔥 Ne rate pas nos astuces tech exclusives !',
    '💻 Rejoins la communauté des passionnés de tech !',
];

let messageInterval = null;

onMounted(() => {
    // 🔹 Toujours afficher le bandeau en dev
    showOverlay.value = true;
    currentMessage.value = messages[Math.floor(Math.random() * messages.length)];

    // Changer le message toutes les 5 secondes
    messageInterval = setInterval(() => {
        currentMessage.value = messages[Math.floor(Math.random() * messages.length)];
    }, 5000);
});

// 🔹 Fermer overlay
const closeOverlay = () => {
    showOverlay.value = false;
    clearInterval(messageInterval);
};

// 🔹 Aller au login
const goToLogin = () => router.visit('/login');

// 🔹 Nettoyage si démontage
onUnmounted(() => {
    clearInterval(messageInterval);
});
</script>

<template>
    <transition name="fade">
        <div v-if="showOverlay" class="bg-opacity-80 fixed inset-0 z-[9999] flex items-center justify-center bg-[#333] opacity-90 backdrop-blur-sm">
            <!-- Card centrale -->
            <div
                class="relative flex w-[85%] max-w-md flex-col items-center gap-4 rounded-xl bg-[#fff] p-6 text-black shadow-lg dark:bg-[var(--dark-blue)] dark:text-[var(--dark-white)]"
            >
                <!-- Croix -->
                <button
                    @click="closeOverlay"
                    class="animate-spin-slow absolute top-3 right-3 text-xl font-bold text-gray-700 transition hover:text-gray-900 dark:text-[var(--dark-white)]"
                >
                    ×
                </button>

                <!-- Message -->
                <h2 class="text-center text-base font-medium sm:text-lg">
                    {{ currentMessage }}
                </h2>

                <!-- Bouton principal -->
                <button
                    @click="goToLogin"
                    class="rounded-md bg-[var(--highlight-gold)] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#f0c930]"
                >
                    Se connecter
                </button>
            </div>
        </div>
    </transition>
</template>

<style scoped>
/* Fade-in animation */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}

/* Responsive */
@media (max-width: 640px) {
    .p-6 {
        padding: 1.2rem;
    }
    h2 {
        font-size: 0.95rem;
    }
    button {
        font-size: 0.875rem;
    }
}

@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin-slow {
    animation: spin-slow 2s linear infinite;
}
</style>
