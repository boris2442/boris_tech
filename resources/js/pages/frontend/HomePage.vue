<script setup>
import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';
import LoginReminder from '@/components/frontend/flash/LoginReminder.vue';
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import Loading from '@/components/frontend/Loading.vue';
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';

import Service from '@/components/frontend/Service.vue';
import Testimony from '@/components/frontend/Testimony.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import { about, products } from '@/routes';
import { Link } from '@inertiajs/vue3';
import { nextTick, onMounted, ref } from 'vue';

// Loader : true si on doit afficher le loader
const showLoading = ref(true);
// Animation Hero : true si les animations doivent se jouer
const animateHero = ref(false);
onMounted(() => {
    if (!sessionStorage.getItem('hasVisited')) {
        // Affiche le loader 2s
        setTimeout(async () => {
            showLoading.value = false; // Fin du loader
            await nextTick(); // attendre que le DOM soit mis à jour
            animateHero.value = true; // lance l'animation
            sessionStorage.setItem('hasVisited', 'true');
        }, 2000);
    } else {
        // Pas la première visite → pas de loader
        showLoading.value = false;
        nextTick(() => {
            animateHero.value = true; // lance l'animation immédiatement
        });
    }
});
</script>
<template>
    <!-- Loader -->
    <Loading v-if="showLoading" />

    <!-- Contenu principal -->
    <div v-else>
        <TopBanner />
        <NavbarFrontend :auth="$page.props.auth" class="mt-10 md:mt-12" />
        <FloatingAction />
        <LoginReminder />
        <FlashMessageNewsletter />
        <!-- Hero Section Premium -->
        <section
            class="relative flex min-h-screen items-start overflow-hidden bg-[#1e293b] bg-cover bg-center bg-no-repeat px-6 pt-24 md:px-16 md:pt-32 lg:px-32 lg:pt-40 dark:bg-[var(--dark-background)] dark:text-[#e0e7ff]"
            style="
                background-image: url('/herop2.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            "
        >
            <!-- Couche d’assombrissement -->
            <div class="absolute inset-0 bg-black/50 dark:bg-black/60"></div>

            <!-- Contenu principal offset à gauche -->
            <div class="relative z-10 flex max-w-4xl -translate-x-2 transform flex-col gap-6 md:-translate-x-0">
                <!-- H1 animé slide + fade -->
                <h1
                    :class="[
                        'max-w-3xl text-2xl leading-snug font-extrabold tracking-tight text-[var(--secondary-white)] drop-shadow-xl sm:text-3xl md:text-4xl lg:text-5xl dark:text-[var(--dark-grey)]',
                        animateHero ? 'translate-y-0 opacity-100 transition-all duration-700 ease-out' : 'translate-y-10 opacity-0',
                    ]"
                >
                    Boris Tech: <br class="sm:block" />Votre expert en équipements informatiques
                </h1>

                <!-- Paragraphe animé fade + slide -->
                <p
                    :class="[
                        'text-base leading-relaxed text-[var(--secondary-white)] sm:text-lg md:text-xl lg:text-2xl dark:text-[var(--dark-grey)]',
                        animateHero ? 'translate-y-0 opacity-100 transition-all delay-200 duration-700 ease-out' : 'translate-y-10 opacity-0',
                    ]"
                >
                    Découvrez nos ordinateurs, smartphones et accessoires électroniques de qualité, conçus pour la performance et la durabilité.
                </p>

                <!-- Bouton animé -->
                <Link
                    :href="products().url"
                    prefetch
                    aria-label="Explorer les produits Boris Tech"
                    :class="[
                        'inline-block max-w-[220px] rounded-lg bg-[var(--highlight-gold)] px-8 py-3 font-semibold text-[var(--secondary-white)] shadow-md transition-transform hover:-translate-y-1 hover:bg-[var(--text-secondary)] dark:bg-[var(--dark-gold)] dark:hover:bg-[var(--dark-accent)]',
                        animateHero ? 'translate-y-0 opacity-100 transition-all delay-400 duration-700 ease-out' : 'translate-y-10 opacity-0',
                    ]"
                >
                    Explorer les produits
                </Link>
            </div>
        </section>

        <!-- Services / About / Testimony / Footer restent identiques -->
        <Service />
        <section id="about" class="bg-[var(--background-light)] py-12 md:py-20 dark:bg-[var(--dark-background)]">
            <div class="container mx-auto flex max-w-6xl flex-col-reverse items-center gap-8 px-4 md:flex-row md:gap-16">
                <!-- Texte -->
                <div class="w-full max-w-xl md:w-1/2 md:text-left">
                    <h2 class="mb-4 text-xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">À propos de Boris Tech</h2>
                    <p
                        class="mb-6 text-base leading-relaxed text-[var(--text-dark)] sm:text-sm sm:leading-6 md:text-base md:leading-7 lg:text-lg lg:leading-8 dark:text-[var(--dark-grey)]"
                    >
                        Chez <span class="font-semibold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Boris Tech</span>, nous croyons que
                        la technologie doit être <span class="text-[var(--highlight-gold)]">accessible, fiable et innovante</span>. Notre mission est
                        d’accompagner particuliers et entreprises avec des solutions modernes, allant des produits électroniques aux services de
                        développement, maintenance et support technique personnalisé. <br /><br />
                        Chaque projet est traité avec attention pour garantir qualité, performance et satisfaction, tout en restant à l’écoute des
                        besoins de nos clients.
                    </p>
                    <ul
                        class="mb-6 space-y-2 text-sm leading-relaxed text-[var(--text-secondary)] sm:text-sm md:text-base dark:text-[var(--dark-grey)]"
                    >
                        <li>✔️ Expertise en produits et solutions technologiques adaptées à chaque client</li>
                        <li>✔️ Service client réactif, professionnel et disponible</li>
                        <li>✔️ Innovation constante et vision orientée vers la satisfaction totale</li>
                    </ul>
                    <Link
                        :href="about().url"
                        prefetch
                        aria-label="En savoir plus sur Boris Tech"
                        class="inline-block rounded-lg bg-[var(--highlight-gold)] px-5 py-3 text-sm font-semibold text-[var(--secondary-white)] shadow-md transition-transform hover:-translate-y-1 hover:bg-[var(--accent-cyan)] sm:text-sm md:text-base dark:bg-[var(--dark-gold)] dark:hover:bg-[var(--dark-accent)]"
                    >
                        En savoir plus
                    </Link>
                </div>

                <!-- Image -->
                <div class="flex w-full justify-center overflow-hidden rounded-lg md:w-1/2 md:justify-end">
                    <img
                        src="assets/about1.jpg"
                        alt="Boris Tech - À propos"
                        class="h-auto w-full max-w-[350px] rounded-lg object-cover shadow-lg transition-transform duration-500 hover:scale-105 sm:max-w-xs md:max-w-sm lg:max-w-md"
                    />
                </div>
            </div>
        </section>

        <Testimony />
       
        <Footer />
    </div>
</template>

<style scoped>
/* Animations */
@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-up {
    animation: fadeUp 0.8s forwards;
}

.delay-200 {
    animation-delay: 0.2s;
}

.delay-400 {
    animation-delay: 0.4s;
}
</style>
