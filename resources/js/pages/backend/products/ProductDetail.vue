<template>
    <FlashMessageNewsletter />
    <CartWidget />

    <Head :title="product.title + ' - Détails du produit'" />
    <TopBanner />
    <FloatingAction />
    <NavbarFrontend :auth="$page.props.auth" class="mt-10 md:mt-12" />
    <BackButton class="mt-4 mb-0" />
    <!-- <LoginReminder v-if="isGuest" /> -->

    <!-- <section class="bg-background-light dark:bg-dark-background text-text-dark dark:text-dark-white p-4 md:p-8">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-8 md:grid-cols-2">
            
            <div class="flex flex-col gap-4 md:flex-row">
       
                <div class="scrollbar-hide flex gap-3 overflow-x-auto md:h-[400px] md:w-[100px] md:flex-col md:overflow-y-auto">
                    <div v-for="(img, index) in product.images" :key="img.id" class="relative h-20 w-20 cursor-pointer">
                      
                        <img
                            :src="getImageUrl(img.url_image)"
                            loading="lazy"
                            :alt="'Image ' + (index + 1)"
                            class="h-full w-full rounded-lg border object-cover transition hover:opacity-80"
                            :class="{ 'ring-2 ring-[var(--primary-blue)]': selectedImage === img.url_image }"
                            @click="selectedImage = img.url_image"
                        />

          
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

             
                <div class="flex flex-1 flex-col items-center justify-center">
        
                    <img
                        loading="lazy"
                        :src="getImageUrl(selectedImage)"
                        :alt="product.title"
                        class="m-0 h-80 w-full rounded-lg object-cover p-0 shadow-lg transition-transform duration-300 hover:scale-105 hover:opacity-95 md:h-[500px]"
                    />

          
                    <div class="mt-3 flex w-full items-center justify-between rounded-lg bg-gray-100 px-3 py-2 dark:bg-gray-800">
                     
                        <button
                            @click="showShare = true"
                            type="button"
                            title="Partager"
                            aria-label="Partager ce produit"
                            class="flex items-center gap-2 rounded-md px-2 py-1 text-sm transition hover:opacity-80"
                        >
                            <FontAwesomeIcon :icon="['fas', 'share-alt']" class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                        </button>

               
                        <div class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                            <Eye class="h-4 w-4" />
                            <span class="text-xs">{{ product.views_count }}</span>
                        </div>
                    </div>
                </div>
            </div>

 
            <div class="relative flex flex-col justify-start md:justify-between">
               
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
    </section> -->

    <section class="bg-background-light dark:bg-dark-background text-text-dark dark:text-dark-white p-4 md:p-8">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-8 md:grid-cols-2">
            <div class="flex flex-col gap-4 md:flex-row">
                <div class="scrollbar-hide flex gap-3 overflow-x-auto md:h-[400px] md:w-[100px] md:flex-col md:overflow-y-auto">
                    <div v-for="(img, index) in product.images" :key="img.id" class="relative h-20 w-20 flex-shrink-0 cursor-pointer">
                        <img
                            :src="getImageUrl(img.url_image)"
                            loading="lazy"
                            class="h-full w-full rounded-lg border object-cover transition hover:opacity-80"
                            :class="{ 'ring-2 ring-[var(--primary-blue)]': selectedImage === img.url_image }"
                            @click="selectedImage = img.url_image"
                        />
                    </div>
                </div>

                <div class="group relative flex flex-1 flex-col items-center justify-center">
                    <img
                        loading="lazy"
                        :src="getImageUrl(selectedImage)"
                        :alt="product.title"
                        class="h-80 w-full rounded-xl object-cover shadow-lg transition-transform duration-500 md:h-[500px]"
                    />

                    <div class="absolute top-4 right-4 flex flex-col gap-3">
                        <button
                            @click="showShare = true"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-white/90 shadow-md backdrop-blur-sm transition hover:bg-white dark:bg-gray-800/90 dark:text-white"
                        >
                            <FontAwesomeIcon :icon="['fas', 'share-alt']" class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                        </button>

                        <div class="flex flex-col items-center justify-center rounded-full bg-black/50 px-2 py-3 text-white backdrop-blur-sm">
                            <Eye class="mb-1 h-4 w-4" />
                            <span class="text-[10px] font-bold">{{ product.views_count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col justify-between">
                <ShareModal :show="showShare" :product="product" @close="showShare = false" />

                <div>
                    <div class="mb-4 flex items-center justify-between border-b pb-4 dark:border-gray-700">
                        <span class="text-xs font-bold tracking-wider text-gray-500 uppercase">{{ product.category.name }}</span>
                        <div class="flex items-center gap-1 text-xs text-gray-400">
                            <Clock class="h-3 w-3" />
                            <span>
                                <i>Publié {{ product.display_date }} </i>
                            </span>
                        </div>
                    </div>

                    <h1 class="mb-2 text-3xl font-bold tracking-tight">{{ product.title }}</h1>
                    <p class="mb-6 leading-relaxed text-gray-600 dark:text-gray-400">{{ product.description }}</p>

                    <div class="mb-6 flex items-center justify-between rounded-xl bg-gray-50 p-4 dark:bg-gray-800/50">
                        <span class="text-2xl font-black text-[var(--primary-blue)]"> {{ product.prix }} <small class="text-sm">FCFA</small> </span>
                        <a
                            :href="whatsAppLink"
                            target="_blank"
                            class="flex items-center gap-2 rounded-full bg-[#00CC5D] px-4 py-2 text-sm font-bold text-white transition hover:scale-105"
                        >
                            <FontAwesomeIcon :icon="['fab', 'whatsapp']" />
                            WhatsApp
                        </a>
                    </div>

                    <div v-if="product.stock >= 1" class="mb-6 flex items-center gap-2">
                        <span class="h-2 w-2 animate-ping rounded-full bg-green-500"></span>
                        <span class="text-sm font-medium text-green-600">Disponible immédiatement</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <button
                        @click="addToCart(product)"
                        class="dark:bg-dark-gold flex w-full items-center justify-center gap-3 rounded-lg bg-[var(--primary-blue)] py-4 text-lg font-bold text-white shadow-lg transition hover:bg-indigo-700 active:scale-95 dark:bg-indigo-500"
                    >
                        <ShoppingCartIcon class="h-6 w-6" />
                        Ajouter au panier
                    </button>

                    <p v-if="!props.auth?.user" class="text-center text-xs text-gray-500 italic">Connectez-vous pour finaliser votre commande.</p>
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
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';
import CartWidget from '@/components/frontend/panier/CartWidget.vue';
import { cartStore } from '@/components/frontend/panier/stores/cart';
import ProductDescriptions from '@/components/frontend/products/ProductDescriptions.vue';
//importation de lucide
import { Clock } from 'lucide-vue-next'
import SimilarProducts from '@/components/frontend/products/SimilarProducts.vue';
import ShareModal from '@/components/frontend/ShareModal.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head, usePage } from '@inertiajs/vue3';
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
    // if (!props.auth?.user) {
    //     if (confirm('Vous devez être connecté pour aimer un produit.\nVoulez-vous vous connecter maintenant ?')) {

    //         router.visit('/login');
    //     }
    //     return;
    // }

    cartStore.add(product);
}
//send url message

const whatsAppNumber = import.meta.env.VITE_WHATSAPP_NUMBER || '237694223503';

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
