<template>
    <Head title="Modifier le post" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <BackButton class="mb-4" />

            <Form :action="posts.update(props.post.id).url" method="put" enctype="multipart/form-data" ref="form">
                <!-- Titre -->
                <div class="mb-4">
                    <label class="mb-1 block font-medium">Titre *</label>
                    <input type="text" name="title" v-model="title" class="w-full rounded border px-3 py-2" />
                </div>

                <!-- Contenu -->
                <div class="mb-4">
                    <label class="mb-1 block font-medium">Contenu *</label>
                    <textarea name="content" v-model="content" class="h-40 w-full rounded border px-3 py-2"></textarea>
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]"> Image du post </label>

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

                <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Mettre à jour</button>
            </Form>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import BackButton from '@/components/frontend/BackButton.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import posts from '@/routes/posts';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    post: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/' },
    { title: 'Posts', href: posts.index().url },
];

const form = ref(null);

// Contenu et image
const title = ref(props.post.title);
const content = ref(props.post.content);
const imagePreview = ref(props.post.image ? `/${props.post.image}` : null);
const imageFile = ref<File | null>(null);

// Gestion image
function handleImage(e: Event) {
    const files = (e.target as HTMLInputElement).files;
    if (!files || !files[0]) return;
    imageFile.value = files[0];
    imagePreview.value = URL.createObjectURL(files[0]);
}

function removeImage() {
    imageFile.value = null;
    imagePreview.value = null;
}
</script>
