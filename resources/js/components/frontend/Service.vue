<!-- ServicesSection.vue -->
<script setup>
import ScrollReveal from 'scrollreveal';
import { onMounted, ref } from 'vue';
// import LoginReminder from '@/components/frontend/flash/LoginReminder.vue';

const services = [
    {
        icon: '💻',
        title: 'Vente d’appareils électroniques',
        description: 'PC, ordinateurs portables, smartphones et équipements électroniques fiables pour particuliers et entreprises.',
    },
    {
        icon: '🧑‍💻',
        title: 'Développement d’applications',
        description: 'Conception et développement d’applications web et mobiles modernes, sécurisées et adaptées à vos besoins.',
    },
    {
        icon: '🌐',
        title: 'Création de sites web',
        description: 'Sites vitrines, e-commerce et plateformes sur mesure avec un design professionnel et une excellente performance.',
    },
    {
        icon: '🎨',
        title: 'Design graphique & UI/UX',
        description: 'Identités visuelles, logos, maquettes UI/UX et supports de communication pour valoriser votre marque.',
    },
    {
        icon: '🛠️',
        title: 'Maintenance & support technique',
        description: 'Maintenance, dépannage, mise à jour et optimisation de vos applications, sites web et équipements.',
    },
    {
        icon: '🚚',
        title: 'Livraison rapide & sécurisée',
        description: 'Livraison rapide de vos appareils et équipements informatiques en toute sécurité.',
    },
    {
        icon: '🔒',
        title: 'Solutions numériques & sécurité',
        description: 'Mise en place de solutions digitales, hébergement, sauvegarde des données et sécurité informatique.',
    },
    {
        icon: '📞',
        title: 'Support client & accompagnement',
        description: 'Assistance personnalisée, conseils et accompagnement 7j/7 pour tous vos projets technologiques.',
    },
];


const visible = ref([]);

// Détection au scroll (Intersection Observer)
onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const index = entry.target.getAttribute('data-index');
                    visible.value[index] = true;
                    observer.unobserve(entry.target); // 👈 stoppe l'observation après apparition
                }
            });
        },
        { threshold: 0.2 },
    );

    document.querySelectorAll('.service-card').forEach((el) => observer.observe(el));
});

// scroll Reveal

onMounted(() => {
    const cards = document.querySelectorAll('.service-card');

    cards.forEach((card, i) => {
        ScrollReveal().reveal(card, {
            duration: 800,
            distance: '50px',
            origin: 'bottom',
            easing: 'ease-out',
            reset: false, // ne rejoue pas
            delay: i * 400, // i = index dans la boucle
        });
    });
});
</script>
<!-- ServicesSection.vue -->
<template>
    <section class="bg-[var(--background-light)] py-4 dark:bg-[var(--dark-background)]" id="services">
        <!-- <LoginReminder /> -->
        <div class="container mx-auto px-6 text-center">
            <!-- Titre -->
            <h2 class="mb-12 text-2xl font-bold text-[var(--primary-blue)] sm:text-3xl dark:text-[var(--dark-white)]">
                Pourquoi choisir <span class="text-[var(--highlight-gold)]">Boris Tech</span> ?
            </h2>

            <!-- Grid des services -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    v-for="(service, index) in services"
                    :key="index"
                    class="service-card group rounded-xl bg-white p-6 shadow-md transition hover:bg-[var(--primary-blue)] hover:text-white hover:shadow-lg dark:bg-[#2A2A2A] dark:hover:bg-[var(--card-dark)]"
                    :class="{
                        'animate-fade-in-up': visible[index],
                    }"
                    :data-index="index"
                >
                    <div class="animate-bounce-slow mb-4 flex justify-center text-4xl text-[var(--accent-cyan)]">
                        {{ service.icon }}
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-[var(--primary-blue)] group-hover:text-[#FFE600] dark:text-[var(--dark-white)]">
                        {{ service.title }}
                    </h3>
                    <p class="text-[var(--text-secondary)] group-hover:text-gray-300 dark:text-[var(--dark-grey)]">
                        {{ service.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
/* Animation fade-in-up */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease forwards;
}

/* Animation lente pour les icônes */
@keyframes bounceSlow {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-6px);
    }
}

.animate-bounce-slow {
    animation: bounceSlow 2.5s infinite;
}
</style>
