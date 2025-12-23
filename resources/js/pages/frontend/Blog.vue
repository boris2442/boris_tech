<template>
    <Head title="Blogs" />
    <TopBanner />
    <FlashMessageNewsletter />
    <FloatingAction />
    <NavbarFrontend :auth="$page.props.auth as Record<string, any> | undefined" class="mt-10 md:mt-12" /><br /><br />
    <FloatingAction />
    <section>
        <LoginReminder v-if="isGuest" />

        <div class="container mx-auto p-4">
            <div class="mb-12 text-center">
                <!-- Icônes animées -->
                <div class="mb-4 flex justify-center gap-6">
                    <svg class="h-8 w-8 animate-bounce text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L15 8H9L12 2Z" />
                    </svg>
                    <svg class="h-8 w-8 animate-bounce text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22L15 16H9L12 22Z" />
                    </svg>
                    <svg class="h-8 w-8 animate-bounce text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="6" />
                    </svg>
                </div>

                <!-- Titre accrocheur -->
                <h1 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Découvrez nos derniers articles</h1>

                <!-- Paragraphe explicatif -->
                <p class="mx-auto max-w-2xl text-lg text-gray-600 dark:text-gray-300">
                    Explorez nos articles pour rester à la pointe de la technologie. Astuces, tutoriels, et nouveautés présentés de manière claire et
                    moderne pour vous inspirer.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="post in [...props.posts].sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime())"
                    :key="post.id"
                    class="overflow-hidden rounded-lg border shadow transition hover:shadow-lg"
                >
                    <article>
                        <Link :href="`/posts/${post.slug}`"  aria-label="Lire l'article">
                            <img
                                v-if="post.image"
                                :src="`${post.image}`"
                                :alt="post.title"
                                loading="lazy"
                                class="h-48 w-full object-cover transition-transform duration-300 hover:scale-105"
                            />
                        </Link>
                        <div class="p-4">
                            <h2 class="mb-2 text-lg font-semibold">{{ post.title }}</h2>
                            <p class="mb-2 text-xs text-gray-500">Publié le {{ formatDate(post.created_at) }}</p>
                            <!-- <p class="mb-3 line-clamp-3 text-gray-700">{{ post.content }}</p> -->
                            <Link :href="`/posts/${post.slug}`" class="font-medium text-blue-500 hover:underline"> Lire la suite </Link>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <Footer />
</template>

<script setup lang="ts">
import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import LoginReminder from '@/components/frontend/flash/LoginReminder.vue';

import { Head, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';

function formatDate(date: string) {
    return dayjs(date).format('DD MMM YYYY');
}

const props = defineProps({
    posts: Array, // tableau simple d'articles
});

import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const isGuest = computed(() => !page.props.auth?.user);

</script>
