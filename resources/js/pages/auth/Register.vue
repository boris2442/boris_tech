<script setup lang="ts">
import RegisteredUserController from '@/actions/App/Http/Controllers/Auth/RegisteredUserController';

import FloatingAction from '@/components/frontend/FloatingAction.vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { login } from '@/routes';
import { Form, Head, Link } from '@inertiajs/vue3';
import { Eye, EyeOff, LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';

const showPassword = ref(false);
const showConfirmPassword = ref(false);

// const loginWithGoogle = () => {
//     router.visit('/login/google', {
//         method: 'get',
//         preserveScroll: true,
//         preserveState: true,
//     });
// };
</script>

<template>
    <FloatingAction />

    <Head title="Register" />
    <div class="flex min-h-screen items-center justify-center bg-gray-100 p-4 dark:bg-[var(--dark-background)]">
        <div class="flex w-full max-w-4xl flex-col overflow-hidden rounded-lg bg-white shadow-lg md:flex-row dark:bg-[var(--dark-background)]">
            <!-- Left Section (Welcome Back) -->
            <div
                class="flex w-full flex-col items-center justify-center bg-[var(--primary-blue)] p-8 text-white sm:rounded-tr-[90px] sm:rounded-br-[90px] md:w-1/2 dark:bg-[#000]"
            >
                <!-- Logo assets/walner.png -->
                <div class="mb-6 text-center">
                    <Link href="/" class="nav-link">
                        <img src="assets/boristech.jpg" alt="Boris Tech" class="z-1000 h-[100px] w-[100px] rounded-full object-cover" />
                    </Link>
                </div>
                <h2 class="mb-2 text-2xl font-bold">Content de vous revoir!</h2>
                <p class="mb-4 text-center">Saisissez vos informations personnelles pour vous connecter à votre compte</p>
            </div>

            <div class="w-full p-8 md:w-1/2 dark:bg-[var(--dark-background)]">
                <h2 class="mb-6 text-xl font-semibold text-[var(--primary-blue)] dark:text-gray-200">Créer un compte</h2>
                <!-- <p class="mb-6 text-sm text-gray-500">ou utilisez votre email pour vous inscrire</p> -->
                <Form
                    v-bind="RegisteredUserController.store.form()"
                    :reset-on-success="['password', 'password_confirmation']"
                    v-slot="{ errors, processing }"
                    class="space-y-6"
                >
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="name" class="text-[var(--primary-blue)]">Nom</Label>
                            <Input
                                class="rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="name"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="name"
                                name="name"
                                placeholder="Votre nom"
                            />
                            <InputError :message="errors.name" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="phone" class="text-[var(--primary-blue)]">Téléphone</Label>
                            <Input
                                class="rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="phone"
                                type="tel"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="phone"
                                name="phone"
                                placeholder="652 22 65 29"
                            />
                            <InputError :message="errors.phone" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="email" class="text-[var(--primary-blue)]">Address email</Label>
                            <Input id="email" type="email" required :tabindex="2" autocomplete="email" name="email" placeholder="email@example.com" />
                            <InputError :message="errors.email" />
                        </div>

                        <!-- Champ Mot de passe -->
                        <div class="relative grid gap-2">
                            <Label for="password" class="text-[var(--primary-blue)]">Mot de passe</Label>
                            <Input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                name="password"
                                placeholder="********"
                                required
                                class="pr-10"
                            />
                            <button
                                type="button"
                                class="absolute top-9 right-3 text-gray-500 transition hover:text-[var(--primary-blue)]"
                                @click="showPassword = !showPassword"
                            >
                                <Eye v-if="!showPassword" class="h-5 w-5" />
                                <EyeOff v-else class="h-5 w-5" />
                            </button>
                            <InputError :message="errors.password" />
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="relative grid gap-2">
                            <Label for="password_confirmation" class="text-[var(--primary-blue)]">Confirmer le mot de passe</Label>
                            <Input
                                :type="showConfirmPassword ? 'text' : 'password'"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="********"
                                required
                                class="pr-10"
                            />
                            <button
                                type="button"
                                class="absolute top-9 right-3 text-gray-500 transition hover:text-[var(--primary-blue)]"
                                @click="showConfirmPassword = !showConfirmPassword"
                            >
                                <Eye v-if="!showConfirmPassword" class="h-5 w-5" />
                                <EyeOff v-else class="h-5 w-5" />
                            </button>
                            <InputError :message="errors.password_confirmation" />
                        </div>

                        <Button
                            type="submit"
                            class="w-full bg-[var(--primary-blue)] text-white hover:bg-[var(--primary-blue2)] dark:bg-[var(--dark-black)] dark:hover:bg-gray-900"
                            :disabled="processing"
                        >
                            <LoaderCircle v-if="processing" class="mr-2 h-4 w-4 animate-spin" />
                            S'inscrire
                        </Button>
                        <!-- Espace entre les boutons -->
                        <div class="my-1 text-center text-gray-400 dark:text-gray-500">ou</div>

                        <!-- Bouton Google -->

                        <a
                            href="/login/google"
                            class="flex w-full items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-700 shadow-sm transition hover:bg-gray-100 dark:bg-[#111] dark:text-gray-200 dark:hover:bg-[#222]"
                        >
                            <!-- Icône Google -->
                            <svg class="h-5 w-5" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill="#4285F4"
                                    d="M533.5 278.4c0-17.7-1.5-34.7-4.3-51.2H272v97h146.9c-6.3 33.8-25 62.5-53.2 81.7v67h85.9c50.3-46.4 79.9-114.8 79.9-194.5z"
                                />
                                <path
                                    fill="#34A853"
                                    d="M272 544.3c72.9 0 134.1-24.2 178.8-65.7l-85.9-67c-23.8 16-54.3 25.5-92.9 25.5-71.3 0-131.7-48-153.3-112.2H32.4v70.5c44.8 88.7 136.7 149.9 239.6 149.9z"
                                />
                                <path fill="#FBBC05" d="M118.7 320.9c-10.6-31.3-10.6-65 0-96.3v-70.5H32.4c-39 76.5-39 166.3 0 242.8l86.3-76z" />
                                <path
                                    fill="#EA4335"
                                    d="M272 107.7c39.5-.6 77.8 14.1 106.7 40.6l80.1-80.1C405.9 24.8 343.9 0 272 0 168.1 0 76.2 61.2 31.4 149.9l87.3 70.5C140.2 155.7 200.6 107.7 272 107.7z"
                                />
                            </svg>
                            Se connecter avec Google
                        </a>
                    </div>
                    <div class="text-center text-sm text-gray-500">
                        Deja un compte?
                        <TextLink :href="login()" class="text-[var(--dark-gold)] hover:underline dark:text-[#ffe600]" :tabindex="5"
                            >Se connecter</TextLink
                        >
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
