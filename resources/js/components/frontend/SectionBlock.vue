<template>
    <section class="mx-auto max-w-6xl px-4 py-4">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-center">
            <!-- Image -->
            <div class="flex justify-center lg:w-1/2">
                <img :src="image" :alt="title" class="w-full max-w-xs rounded-xl shadow-md sm:max-w-sm lg:max-w-md" loading="lazy" />
            </div>

            <!-- Texte -->
            <div class="text-center lg:w-1/2 lg:text-left">
                <h2 class="mb-3 text-2xl font-bold sm:text-3xl">
                    {{ title }}
                </h2>

                <!-- Texte simple -->
                <p v-if="content" class="text-sm leading-relaxed sm:text-[15px] md:text-[16px]" v-html="content"></p>

                <!-- Liste (Nos valeurs) -->
                <ul v-if="items" class="mt-4 space-y-4 text-sm sm:text-[15px] md:text-[16px]">
                    <li v-for="(item, index) in items" :key="index" class="flex items-start gap-3">
                        <font-awesome-icon :icon="item.icon" class="mt-1" />
                        <span v-html="item.text"></span>
                    </li>
                </ul>

                <!-- Bouton (Contact) -->
                <div v-if="button" class="mt-6">
                    <Link :href="button.link" class="inline-block rounded-lg bg-blue-600 px-6 py-3 text-white">
                        {{ button.label }}
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    title: String,
    image: String,
    content: String,
    items: Array,
    button: Object,
});
</script>
