<script setup lang="ts">
import SubmitButton from '@/components/backend/forms/SubmitButton.vue';
import BackButton from '@/components/frontend/BackButton.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import posts from '@/routes/posts';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const imagePreview = ref(null);

// Breadcrumb
const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Posts', href: posts.index().url },
    { title: 'Créer un post', href: posts.create().url },
];

// Gestion image
function handleImage(e: Event) {
    const file = (e.target as HTMLInputElement).files?.[0];
    if (!file) return;

    imagePreview.value = URL.createObjectURL(file);
}

function removeImage() {
    imagePreview.value = null;
}
</script>

<template>
    <Head title="Créer un Post" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <BackButton class="m-4" />
            <div class="relative min-h-[80vh] flex-1 rounded-xl border border-sidebar-border/70 p-6 dark:border-sidebar-border">
                <h1 class="mb-4 text-xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Ajouter un Post</h1>

                <!-- Formulaire Inertia -->
                <Form :action="posts.store()" method="post" enctype="multipart/form-data">
                    <!-- Titre -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">Titre *</label>
                        <input
                            type="text"
                            name="title"
                            class="w-full rounded border px-3 py-2 focus:border-[var(--primary-blue)]"
                            placeholder="Titre du post"
                        />
                        <span class="text-sm text-red-500" v-if="$page.props.errors?.title">
                            {{ $page.props.errors.title }}
                        </span>
                    </div>

                    <!-- Contenu -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">Contenu *</label>
                        <textarea
                            name="content"
                            class="h-40 w-full rounded border px-3 py-2 focus:border-[var(--primary-blue)]"
                            placeholder="Rédigez votre post ici..."
                        ></textarea>
                        <span class="text-sm text-red-500" v-if="$page.props.errors?.content">
                            {{ $page.props.errors.content }}
                        </span>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]"> Image du post * </label>

                        <!-- Zone drag & drop / clic -->
                        <div
                            class="mt-1 flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed hover:border-[var(--primary-blue)] dark:hover:border-[var(--dark-gold)]"
                            @click="$refs.fileInput.click()"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="mb-2 h-8 w-8 text-blue-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0l-4 4m4-4l4 4"
                                />
                            </svg>

                            <p class="text-sm text-gray-500">
                                <span class="text-purple-600">Cliquez pour uploader</span> ou glissez-déposez<br />
                                PNG, JPG, WEBP (max. 2MB)
                            </p>

                            <input ref="fileInput" type="file" name="image" accept="image/*" @change="handleImage" class="hidden" />
                        </div>

                        <!-- Aperçu image -->
                        <div v-if="imagePreview" class="relative mt-3 w-max">
                            <img :src="imagePreview" class="h-24 w-24 rounded border object-cover" />
                            <button
                                type="button"
                                @click="removeImage"
                                class="absolute -top-2 -right-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 font-bold text-white hover:bg-red-600"
                            >
                                ×
                            </button>
                        </div>

                        <span class="mt-1 text-sm text-red-500" v-if="$page.props.errors?.image">
                            {{ $page.props.errors.image }}
                        </span>
                    </div>

                    <!-- Bouton -->
                    <SubmitButton label="Publier le post" />
                </Form>
            </div>
        </div>
    </AppLayout>
</template>
