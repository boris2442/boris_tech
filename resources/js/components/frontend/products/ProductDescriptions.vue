
<template>
    <section class="bg-background-light product-descriptions py-8 shadow-inner dark:bg-[var(--highlight-gold)]">
        <h2 class="mb-6 text-2xl font-bold">Descriptions supplémentaires</h2>

        <div
            v-if="descriptionProduct && descriptionProduct.content"
            class="rounded-lg border-l-4 border-[var(--primary-blue)] bg-white p-4 text-sm leading-relaxed text-gray-700 shadow-sm md:p-6 md:text-base dark:bg-gray-800 dark:text-gray-300"
        >
            <!-- Contenu dynamique -->
            <p :class="{ 'line-clamp-1': !showFull }">
                {{ descriptionProduct.content }}
            </p>

            <!-- Bouton toggle -->
            <button @click="toggleDescription" class="mt-2 text-[var(--primary-blue)] hover:underline">
                {{ showFull ? 'Voir moins' : 'Voir plus' }}
            </button>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    descriptionProduct: {
        type: Object,
        default: null,
    },
});

// État pour afficher ou cacher la description complète
const showFull = ref(false);

function toggleDescription() {
    showFull.value = !showFull.value;
}
</script>

<style scoped>
/* Limite le texte à 4 lignes, nécessite Tailwind Line Clamp plugin */
.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
