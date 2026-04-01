<script setup lang="ts">
import Input from '@/components/backend/forms/Input.vue';
import SubmitButton from '@/components/backend/forms/SubmitButton.vue';
import BackButton from '@/components/frontend/BackButton.vue';
import RichText from '@/components/RichText.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import products from '@/routes/products';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
// Props venant du controller
const props = defineProps({
    categories: Array,
});

// Breadcrumb
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'dashboard',
        href: dashboard().url,
    },
    {
        title: 'Products List',
        href: products.index().url,
    },
    {
        title: 'Products create',
        href: products.create().url,
    },
];

// Formulaire Inertia
const form = useForm({
    title: '',
    description: '',
    prix: '',
    is_promo: false, // Nouveau
    old_price: '', // Nouveau
    stock: 0,
    category_id: '',
    status: 'disponible',
    images: [],
});

// Aperçu des images
const imagePreviews = ref([]);

// Submit formulaire simplifié et fonctionnel
const submitForm = () => {
    // Inertia gère automatiquement le FormData si 'images' contient des fichiers
    form.post('/admin/products/store', {
        forceFormData: true, // Force l'envoi en multipart/form-data pour les fichiers
        onSuccess: () => {
            form.reset();
            imagePreviews.value = [];
        },
        onError: (errors) => {
            console.log('Erreurs de validation :', errors);
        },
    });
};

// Gestion fichiers images
const handleFiles = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (!target.files) return;
    form.images = Array.from(target.files);
    imagePreviews.value = form.images.map((file) => URL.createObjectURL(file));
};

const removeImage = (index: number) => {
    form.images.splice(index, 1); // supprime le fichier du form
    imagePreviews.value.splice(index, 1); // supprime l’aperçu
};
</script>

<template>
    <Head title="Créer un Produit" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <BackButton class="m-4" />
            <div class="relative min-h-[80vh] flex-1 rounded-xl border border-sidebar-border/70 p-6 dark:border-sidebar-border">
                <h1 class="mb-4 text-xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Ajouter un Produit</h1>

                <form @submit.prevent="submitForm" enctype="multipart/form-data" class="flex flex-col gap-4">
                    <Input label="Titre du produit" v-model="form.title" :error="form.errors.title" />
                    <span v-if="form.errors.title" class="text-sm">{{ form.errors.title }}</span>
                    <!-- <Textarea label="Description" v-model="form.description" :error="form.errors.description" /> -->

                    <RichText label="Description" v-model="form.description" :error="form.errors.description" />

                    <span v-if="form.errors.description" class="text-sm">{{ form.errors.description }}</span>
                    <Input label="Prix actuel" v-model="form.prix" type="number" :error="form.errors.prix" />

                    <!-- //checkbox -->
                    <div
                        class="flex items-center gap-2 rounded-lg border border-dashed border-gray-300 bg-gray-50 p-2 dark:border-zinc-700 dark:bg-zinc-900"
                    >
                        <input
                            type="checkbox"
                            id="is_promo"
                            v-model="form.is_promo"
                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        />
                        <label for="is_promo" class="cursor-pointer text-sm font-medium text-gray-700 dark:text-zinc-300">
                            Mettre ce produit en promotion
                        </label>
                    </div>

                    <!--  -->
                    <div v-if="form.is_promo" class="grid grid-cols-1 gap-4 border-l-4 border-orange-400 bg-orange-50 p-4 dark:bg-orange-900/10">
                        <Input
                            label="Ancien Prix (Prix barré)"
                            v-model="form.old_price"
                            type="number"
                            placeholder="Ex: 12000"
                            :error="form.errors.old_price"
                        />
                        <p class="text-[10px] text-orange-600 dark:text-orange-400">
                            Note: Le "Prix Actuel" sera le prix payé, l'"Ancien Prix" sera affiché barré.
                        </p>
                    </div>

                    <Input label="Stock" v-model="form.stock" type="number" :error="form.errors.stock" />
                    <span v-if="form.errors.stock" class="text-sm">{{ form.errors.stock }}</span>
                    <div>
                        <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]"> Catégorie </label>
                        <select
                            v-model="form.category_id"
                            required
                            class="w-full rounded border p-2 focus:ring-2 focus:ring-[var(--primary-blue)] focus:outline-none dark:border-gray-600 dark:bg-[#2A2A2A] dark:focus:ring-[var(--dark-gold)]"
                        >
                            <option value="" disabled class="text-xs">Choisir une catégorie</option>
                            <option class="text-xs" v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                        <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-500">{{ form.errors.category_id }}</p>
                    </div>

                    <div>
                        <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">Images *</label>

                        <!-- Zone de drag & drop / clic -->
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
                                PNG, JPG, GIF, SVG, WEBP (max. 2MB)
                            </p>
                            <input
                                ref="fileInput"
                                type="file"
                                multiple
                                accept="image/png, image/jpeg, image/gif, image/svg+xml, image/webp"
                                @change="handleFiles"
                                class="hidden"
                            />
                        </div>

                        <!-- Aperçu des images -->

                        <div class="mt-2 flex flex-wrap gap-2">
                            <div v-for="(img, index) in imagePreviews" :key="index" class="relative">
                                <img :src="img" class="h-20 w-20 rounded border object-cover" />
                                <!-- Croix de suppression -->
                                <button
                                    type="button"
                                    @click="removeImage(index)"
                                    class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white hover:bg-red-600"
                                >
                                    ×
                                </button>
                            </div>
                        </div>

                        <!-- Erreur -->
                        <span v-if="form.errors.images" class="mt-1 text-sm text-red-500">{{ form.errors.images }}</span>
                    </div>

                    <SubmitButton :processing="form.processing" label="Enregistrer" />
                </form>
            </div>
        </div>
    </AppLayout>
</template>
