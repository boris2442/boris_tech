<script setup lang="ts">
import BackButton from '@/components/frontend/BackButton.vue';
import FlashMessageFrontend from '@/components/frontend/flash/FlashMessageFrontend.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import postsRoute from '@/routes/posts';
import { type BreadcrumbItem } from '@/types';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { Edit2, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';
const showActions = ref(false);
const deletePost = (id: number) => {
    if (confirm('Voulez-vous vraiment supprimer ce post ?')) {
        Inertia.delete(`/admin/posts/${id}`, { preserveScroll: true });
    }
};
//{post}

function formatDate(date: string) {
    return dayjs(date).format('DD/MM/YYYY HH:mm');
}
const props = defineProps({
    posts: Object, // Posts venant du controller
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/' },
    { title: 'Posts', href: postsRoute.index().url },
    // { title: 'Liste des Posts', href: postsRoute.index().url },
];
</script>

<template>
    <Head title="Liste des Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <FlashMessageFrontend v-if="$page.props.flash?.message" :message="$page.props.flash.message" :link="$page.props.flash.link" />
            <BackButton class="mb-4" />

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
                <div class="kpi-card">
                    <div class="kpi-icon">🆕</div>
                    <div class="kpi-text">
                        <h3>Total produit à décrire</h3>
                        <p></p>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-icon">🆕</div>
                    <div class="kpi-text">
                        <h3>Descriptions deja effectuée</h3>
                        <p></p>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-icon">🆕</div>
                    <div class="kpi-text">
                        <h3>Produits sans description</h3>
                        <p></p>
                    </div>
                </div>
            </div>

            <h1 class="my-2 mb-4 text-xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Article</h1>

            <div class="mb-4 flex flex-col gap-4 p-2 md:flex-row">
                <div class="relative w-full">
                    <input type="text" placeholder="Search..." class="custom-input" />
                    <font-awesome-icon icon="magnifying-glass" class="custom-icon" />
                    <button type="button" class="clear-btn">✕</button>
                </div>

                <div class="relative">
                    <button @click="showActions = !showActions" class="rounded border p-2 hover:bg-gray-100 dark:hover:bg-gray-700">⋮</button>

                    <div v-if="showActions" class="absolute right-0 z-50 mt-2 w-48 rounded border bg-white shadow-lg dark:bg-gray-800">
                        <ul>
                            <li>
                                <Link
                                    :href="postsRoute.create.url()"
                                    prefetch
                                    class="block w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    Créer une description
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="post in props.posts.data" :key="post.id" class="relative rounded-lg border p-4 shadow transition hover:shadow-lg">
                    <img
                        v-if="post.image"
                        :src="`${post.image}`"
                        alt=""
                        class="mb-3 h-40 w-full rounded object-cover transition-all hover:scale-105"
                    />

                    <h2 class="text-lg font-semibold">{{ post.title }}</h2>
                    <p class="mb-3 text-xs text-gray-500">
                        <i> Creer le {{ formatDate(post.created_at) }}</i>
                    </p>
                    <p class="line-clamp-3 text-gray-700">{{ post.content }}</p>

                    <div class="mt-4 flex justify-between">
                        <Link :href="postsRoute.edit(post.id).url" class="text-blue-500 hover:underline"> <Edit2 class="h-5 w-5" /> </Link>
                     
                        <button @click="deletePost(post.id)" type="submit" class="text-red-500 hover:underline"><Trash2 class="h-5 w-5" /></button>
                        <!-- </form> -->
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <!-- <div class="mt-6">
                <Pagination :links="props.posts.links" />
            </div> -->
        </div>
    </AppLayout>
</template>
