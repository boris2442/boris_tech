<template>
    <Head :title="post.title" />

    <TopBanner />
    <NavbarFrontend :auth="$page.props.auth" class="mt-10 md:mt-12" />
    <FlashMessageNewsletter />
    <FloatingAction />
    <div class="container mx-auto mb-24 p-4">
        <!-- Article -->
        <article class="mx-auto max-w-4xl rounded-lg border p-6 shadow">
            <img
                v-if="post.image"
                :src="post.image"
                :alt="post.title"
                loading="lazy"
                class="mb-6 h-80 w-full rounded-lg object-cover transition-transform duration-300 hover:scale-105"
            />

            <h1 class="mb-2 text-2xl font-bold">{{ post.title }}</h1>
            <p class="mb-2 text-xs text-gray-500">Publié le {{ formatDate(post.created_at) }}</p>
            <div class="prose dark:prose-invert max-w-full" v-html="post.content"></div>
        </article>

        <!-- Commentaires -->
        <section class="mx-auto mt-12 max-w-4xl">
            <h2 class="mb-4 text-xl font-semibold">Commentaires ({{ post.comments_count }})</h2>

            <!-- <div v-for="comment in post.comments" :key="comment.id" class="mb-4 rounded-lg border p-3 shadow-sm">
                <p class="text-sm text-gray-700">
                    <span class="font-semibold">{{ comment.user.name }}</span> dit :
                </p>
                <p class="text-gray-600">{{ comment.content }}</p>
                <p class="mt-1 text-xs text-gray-400">
                    <i>{{ formatDate(comment.created_at) }}</i>
                </p>
            </div> -->

            <div
                v-for="comment in post.comments"
                :key="comment.id"
                class="mb-4 flex items-start gap-3 rounded-lg border bg-white p-3 shadow-sm dark:bg-gray-800"
            >
                <!-- Avatar -->
                <img
                    :src="comment.user.profile_photo ?? `https://ui-avatars.com/api/?name=${comment.user.name}&background=0D8ABC&color=fff&size=64`"
                    alt="avatar"
                    class="h-10 w-10 rounded-full object-cover"
                />

                <!-- Contenu -->
                <div class="flex-1">
                    <p class="text-sm text-gray-700 dark:text-gray-200">
                        <span class="font-semibold">{{ comment.user.name }}</span>
                    </p>
                    <p class="text-gray-600 dark:text-gray-300">{{ comment.content }}</p>
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                        <i>{{ formatDate(comment.created_at) }}</i>
                    </p>
                </div>
            </div>

            <!-- Formulaire commentaire -->
            <!-- <Form :action="`/posts/${post.id}/comments`" method="post" preserve-scroll @success="() => $event.target.reset()">
                <div class="relative mt-6 w-full">
               
                    <textarea
                        name="content"
                        v-model="newComment"
                        placeholder="Écrire un commentaire..."
                        class="w-full resize-none rounded-lg border border-gray-300 px-4 py-3 pr-12 focus:ring-2 focus:ring-[var(--dark-blue)] focus:outline-none dark:border-gray-600 dark:focus:ring-[var(--dark-gold)]"
                        rows="3"
                    ></textarea>

                
                    <button
                        title="envoyer "
                        @click="submitComment"
                        class="absolute right-2 bottom-2 flex h-9 w-9 items-center justify-center rounded-full bg-blue-500 text-white transition hover:bg-blue-600"
                    >
                        <SendIcon class="h-5 w-5" />
                    </button>
                </div>
            </Form> -->

            <!-- Formulaire commentaire -->
            <section class="mt-6">
                <div v-if="$page.props.auth?.user">
                    <!-- Si connecté, afficher le formulaire -->
                    <Form :action="`/posts/${post.id}/comments`" method="post" preserve-scroll @success="() => $event.target.reset()">
                        <div class="relative w-full">
                            <textarea
                                name="content"
                                v-model="newComment"
                                placeholder="Écrire un commentaire..."
                                class="w-full resize-none rounded-lg border border-gray-300 px-4 py-3 pr-12 focus:ring-2 focus:ring-[var(--dark-blue)] focus:outline-none dark:border-gray-600 dark:focus:ring-[var(--dark-gold)]"
                                rows="3"
                            ></textarea>

                            <button
                                title="Envoyer"
                                @click="submitComment"
                                class="absolute right-2 bottom-2 flex h-9 w-9 items-center justify-center rounded-full bg-blue-500 text-white transition hover:bg-blue-600"
                            >
                                <SendIcon class="h-5 w-5" />
                            </button>
                        </div>
                    </Form>
                </div>

                <div
                    v-else
                    class="mt-4 flex flex-col items-center gap-2 rounded-lg border border-gray-300 bg-gray-50 p-4 text-center dark:border-gray-700 dark:bg-gray-800"
                >
                    <p class="text-gray-700 dark:text-gray-300">Vous devez être connecté pour commenter.</p>
                    <Link href="/login" class="animate-bounce rounded-lg bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600">
                        Se connecter
                    </Link>
                </div>
            </section>
        </section>
    </div>

    <Footer />
</template>

<script setup lang="ts">
import FlashMessageNewsletter from '@/components/FlashMessageNewsletter.vue';
import FloatingAction from '@/components/frontend/FloatingAction.vue';
import Footer from '@/components/frontend/Footer.vue';
import NavbarFrontend from '@/components/frontend/NavbarFrontend.vue';
import TopBanner from '@/components/frontend/TopBanner.vue';
import { Form, Head,Link } from '@inertiajs/vue3';
//import {  } from '@inertiajs/inertia-vue3';
import dayjs from 'dayjs';
import { Send } from 'lucide-vue-next';
import { ref } from 'vue';

const SendIcon = Send;

const props = defineProps({
    post: Object, // l'article complet avec commentaires
});

const newComment = ref('');

function formatDate(date: string) {
    return dayjs(date).format('DD MMM YYYY HH:mm');
}

function submitComment() {
    if (!newComment.value.trim()) return;

    $inertia.post(
        `/posts/${props.post.id}/comments`,
        { content: newComment.value },
        {
            onSuccess: () => (newComment.value = ''),
        },
    );
}
</script>
