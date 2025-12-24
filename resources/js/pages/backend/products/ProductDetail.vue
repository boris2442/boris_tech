<template>
    <FlashMessageNewsletter />
    <CartWidget />

    <Head :title="product.title + ' - Détails du produit'" />
    <TopBanner />
    <FloatingAction />
    <NavbarFrontend :auth="$page.props.auth" class="mt-10 md:mt-12" />
    <BackButton class="mt-4 mb-0" />
    <!-- <LoginReminder v-if="isGuest" /> -->
    <section class="bg-background-light dark:bg-dark-background text-text-dark dark:text-dark-white p-4 md:p-8">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-8 md:grid-cols-2">
            <!-- Images -->
            <div class="flex flex-col gap-4 md:flex-row">
                <!-- Miniatures -->
                <div class="scrollbar-hide flex gap-3 overflow-x-auto md:h-[400px] md:w-[100px] md:flex-col md:overflow-y-auto">
                    <!-- <img
                        v-for="(img, index) in product.images"
                        :key="img.id"
                        :src="getImageUrl(img.url_image)"
                        loading="lazy"
                        :alt="'Image ' + (index + 1)"
                        class="h-20 w-20 cursor-pointer rounded-lg border object-cover transition hover:opacity-90"
                        :class="{ 'ring-2 ring-[var(--primary-blue)]': selectedImage === img.url_image }"
                        @click="selectedImage = img.url_image"
                    /> -->

                    <div v-for="(img, index) in product.images" :key="img.id" class="relative h-20 w-20 cursor-pointer">
                        <!-- MINIATURE -->
                        <img
                            :src="getImageUrl(img.url_image)"
                            loading="lazy"
                            :alt="'Image ' + (index + 1)"
                            class="h-full w-full rounded-lg border object-cover transition hover:opacity-80"
                            :class="{ 'ring-2 ring-[var(--primary-blue)]': selectedImage === img.url_image }"
                            @click="selectedImage = img.url_image"
                        />

                        <!-- CHECKBOX PROFESSIONNEL SUR MINIATURE -->
                        <div
                            v-if="selectedImage === img.url_image"
                            class="absolute top-1 left-1 z-10 flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white shadow-md"
                        >
                            <svg class="h-3 w-3 text-[var(--primary-blue)]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Image principale -->

                <!-- Image principale -->
                <div class="flex flex-1 flex-col items-center justify-center">
                    <!-- L'image -->
                    <img
                        loading="lazy"
                        :src="getImageUrl(selectedImage)"
                        :alt="product.title"
                        class="m-0 h-80 w-full rounded-lg object-cover p-0 shadow-lg transition-transform duration-300 hover:scale-105 hover:opacity-95 md:h-[500px]"
                    />

                    <!-- BARRE PARTAGER + VUES SOUS L'IMAGE -->
                    <div class="mt-3 flex w-full items-center justify-between rounded-lg bg-gray-100 px-3 py-2 dark:bg-gray-800">
                        <!-- Bouton partager -->
                        <button
                            @click="showShare = true"
                            type="button"
                            title="Partager"
                            aria-label="Partager ce produit"
                            class="flex items-center gap-2 rounded-md px-2 py-1 text-sm transition hover:opacity-80"
                        >
                            <FontAwesomeIcon :icon="['fas', 'share-alt']" class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                        </button>

                        <!-- Vues -->
                        <div class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                            <Eye class="h-4 w-4" />
                            <span class="text-xs">{{ product.views_count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Infos produit -->
            <div class="relative flex flex-col justify-start md:justify-between">
                <!-- Share modal -->
                <ShareModal :show="showShare" :product="product" @close="showShare = false" />

                <div>
                    <h1 class="mb-2 text-3xl font-bold">{{ product.title }}</h1>
                    <p class="mb-2 leading-relaxed text-gray-700 dark:text-gray-300">{{ product.description }}</p>
                    <p class="text-md mb-3 flex justify-between font-semibold text-[var(--primary-blue)]">
                        <span class="dark:text-gray-300">
                            <strong class="underline"> {{ product.prix }}</strong> FCFA
                        </span>
                        <span>
                            <a
                                :href="whatsAppLink"
                                target="_blank"
                                rel="noopener noreferrer"
                                title="Contacter Boris Tech via WhatsApp"
                                class="flex h-8 items-center justify-center rounded bg-[#00CC5D] px-4 py-2 font-semibold text-white transition duration-200 ease-in-out hover:opacity-90"
                            >
                                <FontAwesomeIcon :icon="['fab', 'whatsapp']" class="ml-2 h-5 w-5 text-sm text-white" />
                                <span class="text-xs">Whatsapp</span>
                            </a>
                        </span>
                    </p>

                    <p v-if="product.stock >= 3" class="mb-2 text-sm font-semibold text-[var(--primary-blue)] dark:text-gray-300">
                        <span class="rounded border border-solid border-[var(--primary-blue)] px-1 py-[2px] dark:border-gray-300">
                            <span>En stock </span>
                        </span>
                        <span class="ml-2 text-xs">{{ product.category.name }}</span>
                    </p>
                    <p v-if="!props.auth?.user" class="my-3 text-xs">
                        <span
                            ><i
                                >Vous devrez etre
                                <strong> <Link prefetch href="login" class="hover:underline dark:text-[var(--dark-gold)]"> connecter </Link> </strong
                                >pour pouvoir reserver!
                            </i></span
                        >
                    </p>
                </div>

                <!-- Bouton Ajouter au panier -->
                <div>
                    <button
                        @click="addToCart(product)"
                        type="button"
                        title="ajout au panier"
                        aria-label="Bouton ajouter au panier"
                        class="dark:bg-dark-gold flex w-full items-center justify-center rounded-lg bg-[var(--primary-blue)] px-6 py-3 text-center font-semibold text-white shadow-md transition hover:opacity-90 md:w-auto dark:text-gray-300"
                    >
                        <ShoppingCartIcon class="animate-spin-slow mr-2" /> Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Dans ton ProductDetail.vue -->
    <div class="mx-auto max-w-6xl px-4" v-if="product.descriptionProduct && product.descriptionProduct.content">
        <ProductDescriptions :description-product="product.descriptionProduct" />
    </div>

    <!-- SimilarProducts components -->
    <SimilarProducts :products="similarProducts" />

    <Footer />
</template>

<script setup>
import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';
import BackButton from '@/components/frontend/BackButton.vue';
import LoginReminder from '@/components/frontend/flash/LoginReminder.vue';
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';
import CartWidget from '@/components/frontend/panier/CartWidget.vue';
import { cartStore } from '@/components/frontend/panier/stores/cart';
import ProductDescriptions from '@/components/frontend/products/ProductDescriptions.vue';
import SimilarProducts from '@/components/frontend/products/SimilarProducts.vue';
import ShareModal from '@/components/frontend/ShareModal.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    product: Object,
    auth: Object,
    similarProducts: Array,
});
const showShare = ref(false);
const selectedImage = ref(null);

onMounted(() => {
    selectedImage.value = props.product.images?.[0]?.url_image || '/fallback.png';
});

function getImageUrl(path) {
    if (!path) return '/fallback.png';
    return `/${path}`;
}

function addToCart(product) {
    if (!props.auth?.user) {
        if (confirm('Vous devez être connecté pour aimer un produit.\nVoulez-vous vous connecter maintenant ?')) {
            // window.location.href = '/login'
            router.visit('/login');
        }
        return;
    }

    cartStore.add(product);
}
//send url message

const whatsAppNumber = import.meta.env.VITE_WHATSAPP_NUMBER || '237656894773';

const whatsAppLink = computed(() => {
    // Sécurité : tronquer et nettoyer le titre
    const rawTitle = props.product.title;
    const cleanTitle = rawTitle.replace(/[*_~`]/g, '');
    const truncatedTitle = cleanTitle.length > 70 ? cleanTitle.slice(0, 67) + '...' : cleanTitle;

    const encodedTitle = encodeURIComponent(truncatedTitle);
    const baseUrl = encodeURIComponent(window.location.href);
    const storeName = 'Boris Tech';

    // Gérer le nom utilisateur ou anonyme
    const userName = props.auth?.user ? encodeURIComponent(props.auth.user.name) : 'Client%20Anonyme'; // encodé manuellement

    const message = `
Bonjour ${storeName},

Je suis intéressé(e) par le produit suivant : *${decodeURIComponent(encodedTitle)}*.

Pourriez-vous me confirmer sa disponibilité et les modalités de livraison ?

Page du produit : ${decodeURIComponent(baseUrl)}

Cordialement,  
${props.auth?.user ? props.auth.user.name : 'Client Anonyme'}
`.trim();

    const encodedMessage = encodeURIComponent(message);
    return `https://wa.me/${whatsAppNumber}?text=${encodedMessage}`;
});

const page = usePage();
const isGuest = computed(() => !page.props.auth?.user);
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.share {
    animation: share 3s linear infinite;
}

@keyframes share {
    0% {
        transform: scale(0);
    }

    50% {
        transform: scale(1.02);
    }

    100% {
        transform: scale(1.05);
    }
}
</style>
