<script setup lang="ts">
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import LoginReminder from '@/components/frontend/flash/LoginReminder.vue';
import BackButton from '@/components/frontend/BackButton.vue';
import { Head } from '@inertiajs/inertia-vue3';
import CartWidget from '@/components/frontend/panier/CartWidget.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';

const sections = [
    {
        title: "1. À propos de Boris Tech",
        content: "Boris Tech est une plateforme spécialisée dans la vulgarisation technologique et la présentation d’appareils électroniques modernes. Notre objectif est de rendre l’innovation accessible à tous à travers des contenus fiables, clairs et pratiques."
    },
    {
        title: "2. Accès au site",
        content: "L’accès au site est libre et gratuit. Toutefois, certaines fonctionnalités comme les newsletters ou commentaires peuvent nécessiter une inscription. Les utilisateurs doivent fournir des informations exactes et mettre à jour leurs données en cas de changement."
    },
    {
        title: "3. Propriété intellectuelle",
        content: "Tous les contenus publiés sur Boris Tech, incluant textes, images, vidéos, logos et codes, sont protégés par les lois sur la propriété intellectuelle. Toute utilisation non autorisée est strictement interdite et pourra donner lieu à des poursuites."
    },
    {
        title: "4. Limitation de responsabilité",
        content: "Boris Tech s'efforce de publier des informations fiables, mais ne garantit pas l’exactitude ou l’exhaustivité des contenus. L’utilisateur est seul responsable de l’usage qu’il fait des informations diffusées sur le site."
    },
    {
        title: "5. Participation des utilisateurs",
        content: "Les utilisateurs peuvent commenter ou partager leurs avis sur certains articles. Les propos injurieux, haineux, discriminatoires ou publicitaires sont strictement interdits. Boris Tech se réserve le droit de supprimer tout contenu inapproprié."
    },
    {
        title: "6. Données personnelles et confidentialité",
        content: "Lors de l’utilisation du site, certaines données personnelles peuvent être collectées (nom, email, préférences). Celles-ci sont utilisées dans un cadre strictement confidentiel et sécurisé. Aucune donnée ne sera vendue ou partagée sans votre consentement. Pour en savoir plus, consultez notre Politique de confidentialité."
    },
    {
        title: "7. Évolution des conditions",
        content: "Boris Tech se réserve le droit de modifier à tout moment les présentes conditions afin de les adapter à l’évolution du site ou à la législation en vigueur. Il est conseillé aux utilisateurs de consulter régulièrement cette page."
    },
    {
        title: "8. Loi applicable et juridiction",
        content: "Les présentes conditions sont régies par le droit en vigueur en République du Cameroun. En cas de litige, la compétence est attribuée aux juridictions de la ville de Bafoussam."
    }
];

</script>

<template>
    <CartWidget />
    <FlashMessageNewsletter />

    <Head title="Conditions Générales d’Utilisation (CGU) " />

    <TopBanner />
    <NavbarFrontend :auth="$page.props.auth as Record<string, any> | undefined" class="mt-10 md:mt-12" />
    <FloatingAction /> <br>
    <section
        class="px-6  antialiased bg-[var(--secondary-white)] text-[var(--text-dark)] dark:bg-[var(--dark-background)] dark:text-[var(--dark-white)]">
        <div class=" mx-auto">
            <LoginReminder />
            <!-- 🔹 Bouton retour -->
            <BackButton />
            <h1 class="text-2xl font-bold mb-8  text-[var(--primary-blue)] dark:text-[var(--dark-accent)]">
                Conditions Générales d’Utilisation 
            </h1>



            <div class="space-y-8 text-[16px] leading-relaxed">
                <div v-for="(section, index) in sections" :key="index">
                    <h2 class="text-2xl font-semibold mb-2  text-[var(--primary-blue)] dark:text-[var(--dark-blue)]">{{
                        section.title }}</h2>
                    <p>{{ section.content }}</p>
                </div>
            </div>
        </div><br />
    </section>
    <Footer />
</template>

<style scoped>
/* Pour les petits ajustements éventuels */
</style>
