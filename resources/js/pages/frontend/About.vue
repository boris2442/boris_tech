<template>
    <FlashMessageNewsletter />
    <CartWidget />

    <!-- Le composant Inertia Head assure aussi le rendu côté serveur -->

    <Head title="A propos de " />
    <TopBanner />

    <NavbarFrontend :auth="$page.props.auth as Record<string, any> | undefined" class="mt-10 md:mt-12" />

    <FloatingAction />
    <!-- <LoginReminder /> -->
    <LoginReminder v-if="isGuest" />

    <!-- 💥 Notification flash visible sur TOUTES les pages -->

    <section
        class="about mt-4 min-h-screen px-6 py-6 text-[var(--text-dark)] md:px-20 lg:px-32 dark:bg-[var(--dark-background)] dark:text-[var(--dark-white)]"
    >
        <h1 class="space-x-10 text-2xl">A propos de Boris Tech</h1>
        <div class="mx-auto max-w-6xl space-y-10">
            <!-- Notre mission -->
            <div>
                <h2 class="mt-6 text-2xl font-semibold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Notre mission</h2>
                <p class="mb-8 text-[14px] leading-relaxed text-[var(--text-dark)] sm:text-[14px] md:text-[16px] dark:text-[var(--dark-grey)]">
                    Chez <strong>Boris Tech</strong>, notre mission est de
                    <span class="text-[var(--highlight-gold)]"> fournir des appareils électroniques de qualité</span> et des accessoires fiables, tout
                    en offrant un service client exceptionnel pour simplifier votre quotidien numérique. <br /><br />
                    Nous combinons expertise technique et approche client pour garantir une expérience optimale à chaque étape, du choix du produit au
                    support après-vente.
                </p>

                <div class="grid gap-6 md:grid-cols-3">
                    <div
                        v-for="(product, index) in products"
                        :key="index"
                        class="group rounded-xl bg-white p-6 shadow-md transition hover:bg-[var(--primary-blue)] hover:text-white hover:shadow-lg dark:bg-[#2A2A2A] hover:dark:bg-[#000]"
                    >
                        <font-awesome-icon
                            :icon="product.icon"
                            class="mb-3 text-2xl text-[var(--primary-blue)] group-hover:text-[#FFE600] dark:text-[var(--dark-gold)]"
                        />

                        <h3 class="mb-2 text-lg font-semibold text-[var(--primary-blue)] group-hover:text-[#FFE600] dark:text-[var(--dark-white)]">
                            {{ product.title }}
                        </h3>

                        <p class="text-sm text-gray-600 group-hover:text-gray-300 dark:text-gray-300">
                            {{ product.description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 
            <div class="mx-auto flex max-w-6xl flex-col-reverse items-center gap-8 p-6 lg:flex-row lg:items-start">
                <div class="lg:w-1/2">
                    <h2 class="mb-4 text-3xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Notre équipe</h2>
                    <p
                        class="text-[15px] leading-relaxed text-[var(--text-dark)] sm:text-[16px] md:text-[17px] lg:leading-[2.2] dark:text-[var(--dark-grey)]"
                    >
                        L’équipe <strong>Boris Tech</strong> rassemble des spécialistes en électronique et service client, dédiés à fournir les
                        meilleurs produits et conseils pour vos besoins technologiques. <br /><br />
                        Nous combinons expertise technique et approche client pour garantir une expérience optimale, que ce soit dans la sélection des
                        produits, la résolution de problèmes techniques ou l’accompagnement personnalisé.
                        <br /><br />
                        Notre objectif : offrir des conseils adaptés, des recommandations fiables et un support réactif. Chez
                        <strong>Boris Tech</strong>, innovation, qualité et proximité guident chaque interaction.
                    </p>
                </div>

                <div class="flex justify-center lg:w-1/2">
                    <div class="overflow-hidden rounded-xl shadow-xl">
                        <img
                            src="assets/about1.jpg"
                            alt="Équipe Boris Tech"
                            loading="lazy"
                            class="h-auto w-full max-w-sm object-cover transition-transform duration-500 hover:scale-105 lg:max-w-md"
                        />
                    </div>
                </div>
            </div>

    
            <div class="mx-auto flex max-w-6xl flex-col-reverse items-center gap-8 p-6 lg:flex-row lg:items-start">
                <div class="flex justify-center lg:w-1/2">
                    <div class="overflow-hidden rounded-xl shadow-xl">
                        <img
                            src="assets/homepage.jpg"
                            alt="Valeurs Boris Tech"
                            loading="lazy"
                            class="h-auto w-full max-w-sm object-cover transition-transform duration-500 hover:scale-105 lg:max-w-md"
                        />
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <h2 class="mb-4 text-3xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Nos valeurs</h2>
                    <ul class="space-y-5 text-[15px] leading-relaxed text-[var(--text-dark)] md:text-[16px] dark:text-[var(--dark-grey)]">
                        <li class="flex items-start gap-4">
                            <font-awesome-icon :icon="['fas', 'bolt']" class="mt-1 text-[var(--primary-blue)] dark:text-[var(--dark-gold)]" />
                            <span
                                ><strong>Qualité :</strong> proposer des produits fiables et durables. Chaque produit est testé pour garantir une
                                expérience optimale.</span
                            >
                        </li>
                        <li class="flex items-start gap-4">
                            <font-awesome-icon :icon="['fas', 'handshake']" class="mt-1 text-[var(--primary-blue)] dark:text-[var(--dark-gold)]" />
                            <span
                                ><strong>Confiance :</strong> établir des relations honnêtes et transparentes. Nous valorisons l’intégrité et les
                                liens durables.</span
                            >
                        </li>
                        <li class="flex items-start gap-4">
                            <font-awesome-icon
                                :icon="['fas', 'headphones-alt']"
                                class="mt-1 text-[var(--primary-blue)] dark:text-[var(--dark-gold)]"
                            />
                            <span
                                ><strong>Service :</strong> accompagnement attentif pour répondre à toutes vos questions et besoins. Nous guidons et
                                conseillons à chaque étape.</span
                            >
                        </li>
                        <li class="flex items-start gap-4">
                            <font-awesome-icon :icon="['fas', 'users']" class="mt-1 text-[var(--primary-blue)] dark:text-[var(--dark-gold)]" />
                            <span
                                ><strong>Innovation :</strong> suivre les dernières tendances technologiques pour offrir le meilleur. Nous
                                investissons dans la recherche et les nouvelles technologies.</span
                            >
                        </li>
                    </ul>
                </div>
            </div>

           
            <div class="mx-auto flex max-w-6xl flex-col-reverse items-center gap-8 p-6 lg:flex-row lg:items-start">
                <div class="lg:w-1/2">
                    <h2 class="mb-4 text-3xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Contactez-nous</h2>
                    <p class="text-[15px] leading-relaxed text-[var(--text-dark)] md:text-[16px] lg:leading-[2.2] dark:text-[var(--dark-grey)]">
                        Vous avez une question ou besoin d’aide pour choisir un produit ? L’équipe <strong>Boris Tech</strong>
                        vous accompagne à chaque étape.
                        <br /><br />
                        Nous vous aidons à trouver le produit adapté à vos besoins, expliquons ses fonctionnalités et proposons les meilleures options
                        disponibles. Que ce soit pour vérifier la compatibilité, résoudre un problème technique ou obtenir des recommandations
                        personnalisées, nous garantissons un support rapide et efficace.
                        <br /><br />
                        N’hésitez pas à nous contacter via notre
                        <Link
                            :href="contact()"
                            class="text-[var(--accent-cyan)] underline hover:text-[var(--highlight-gold)] dark:text-[var(--dark-gold)]"
                        >
                            page de contact
                        </Link>
                        pour échanger directement avec nous. Nous sommes disponibles pour répondre à toutes vos questions et assurer votre entière
                        satisfaction.
                    </p>
                </div>

                <div class="flex justify-center lg:w-1/2">
                    <div class="overflow-hidden rounded-xl shadow-xl">
                        <img
                            src="assets/about2.jpg"
                            alt="Contact Boris Tech"
                            loading="lazy"
                            class="h-auto w-full max-w-sm object-cover transition-transform duration-500 hover:scale-105 lg:max-w-md"
                        />
                    </div>
                </div>
            </div> -->

            <SectionBlock
                title="Notre équipe"
                image="assets/about1.jpg"
                content="
    L’équipe <strong>Boris Tech</strong> réunit des experts en électronique
    et services numériques.
    <br /><br />
    Nous accompagnons nos clients avec professionnalisme et proximité.
  "
            />

            <SectionBlock
                title="Nos valeurs"
                image="assets/about1.jpg"
                :items="[
                    { icon: ['fas', 'bolt'], text: '<strong>Qualité :</strong> produits fiables.' },
                    { icon: ['fas', 'handshake'], text: '<strong>Confiance :</strong> relations honnêtes.' },
                    { icon: ['fas', 'headphones'], text: '<strong>Service :</strong> assistance réactive.' },
                    { icon: ['fas', 'users'], text: '<strong>Innovation :</strong> solutions modernes.' },
                ]"
            />

            <!-- <SectionBlock
                title="Contactez-nous"
                image="assets/about2.jpg"
                content="
    Une question ou un besoin ?
    L’équipe <strong>Boris Tech</strong> est à votre écoute.
  "
                :button="{ label: 'Nous contacter', link: route('contact') }"
            /> -->
        </div>
    </section>
    <Footer />
</template>

<script lang="ts" setup>
import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';
import LoginReminder from '@/components/frontend/flash/LoginReminder.vue';
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';
import CartWidget from '@/components/frontend/panier/CartWidget.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faBolt, faHandshake, faHeadphones, faLaptop, faMobileAlt, faUsers } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
// import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';
// CORRECT si le dossier est "components"
import SectionBlock from '@/components/frontend/SectionBlock.vue';

library.add(faLaptop, faMobileAlt, faHeadphones, faBolt, faUsers, faHandshake);
const page = usePage();
const isGuest = computed(() => !page.props.auth?.user);

const products = [
    {
        icon: ['fas', 'laptop'],
        title: 'Vente d’ordinateurs & périphériques',
        description: 'Ordinateurs portables et fixes, périphériques et équipements informatiques authentiques, certifiés et garantis.',
    },
    {
        icon: ['fas', 'mobile-alt'],
        title: 'Téléphones & accessoires',
        description: 'Smartphones et accessoires avec livraison rapide et sécurisée dès 3h selon la zone.',
    },
    {
        icon: ['fas', 'headphones'],
        title: 'Service après-vente & support',
        description: 'Service après-vente Boris Tech avec assistance, support agréé et retour simple sous 7 jours.',
    },
    {
        icon: ['fas', 'bolt'],
        title: 'Développement d’applications web & mobiles',
        description: 'Développement d’applications web et mobiles sur mesure, adaptées à vos besoins professionnels.',
    },
    {
        icon: ['fas', 'users'],
        title: 'Création de sites web & e-commerce',
        description: 'Création de sites web professionnels, vitrines et e-commerce performants et sécurisés.',
    },
    {
        icon: ['fas', 'handshake'],
        title: 'Maintenance & accompagnement IT',
        description: 'Maintenance, mises à jour, optimisation technique et accompagnement personnalisé pour vos projets numériques.',
    },
];
</script>
