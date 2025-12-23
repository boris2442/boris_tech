<script setup lang="ts">
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';

import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { request } from '@/routes/password';
import { Form, Head, Link } from '@inertiajs/vue3';
import { Eye, EyeOff, LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
const showPassword = ref(false);
const showConfirmPassword = ref(false);
defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
// Fonction pour rediriger vers Google OAuth
const loginWithGoogle = () => {
    window.location.href = '/login/google';
};
</script>

<template>
    <AuthBase title="Connectez-vous à votre compte Boris Tech" description="Entrez votre email et votre mot de passe ci-dessous pour vous connecter">
        <Head title="Log in" />
        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <div class="flex items-center justify-center">
            <div class="flex w-full max-w-4xl flex-col overflow-hidden rounded-lg bg-white shadow-lg md:flex-row dark:bg-[var(--dark-background)]">
                <!-- Left Section (Sign In Form) -->
                <div class="w-full p-6 md:w-1/2 md:p-8">
                    <div class="py-4 text-center text-gray-400"></div>
                    <Form
                        v-bind="AuthenticatedSessionController.store.form()"
                        :reset-on-success="['password']"
                        v-slot="{ errors, processing }"
                        class="space-y-6"
                    >
                        <div class="grid gap-4">
                            <div class="grid gap-2">
                                <Label for="email" class="text-[var(--primary-blue)]">Adresse email</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="email"
                                    placeholder="email@example.com"
                                />
                                <InputError :message="errors.email" />
                            </div>
                            <div class="relative grid gap-2">
                                <div class="flex items-center justify-between">
                                    <Label for="password" class="text-[var(--primary-blue)]">Mot de passe</Label>
                                    <TextLink
                                        v-if="canResetPassword"
                                        :href="request()"
                                        class="text-sm text-[var(--primary-blue)] hover:underline dark:text-[#ffe600]"
                                        :tabindex="5"
                                    >
                                        Mot de passe oublié?
                                    </TextLink>
                                </div>
                                <Input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    required
                                    :tabindex="2"
                                    autocomplete="current-password"
                                    placeholder="Password"
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
                            <div class="flex items-center justify-between">
                                <Label for="remember" class="flex items-center space-x-3">
                                    <Checkbox id="remember" name="remember" :tabindex="3" class="bg-[var(--primary-blue)]" />
                                    <span class="text-[var(--primary-blue)] dark:text-[#ffe600]">Se souvenir de moi</span>
                                </Label>
                            </div>
                            <Button
                                type="submit"
                                class="w-full bg-[var(--primary-blue)] text-white hover:bg-[var(--primary-blue2)] dark:bg-[var(--dark-black)]"
                                :tabindex="4"
                                :disabled="processing"
                            >
                                <LoaderCircle v-if="processing" class="mr-2 h-4 w-4 animate-spin" />
                                Se connecter
                            </Button>

                            <!-- Séparateur -->
                            <div class="my-1 text-center text-gray-400 dark:text-gray-500">ou</div>

                            <!-- Bouton Google -->
                            <button
                                type="button"
                                @click="loginWithGoogle"
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
                            </button>
                        </div>
                        <div class="text-center text-sm text-gray-500">
                            Vous n'avez pas de compte ?
                            <TextLink :href="register()" class="text-xl text-[var(--primary-blue)] hover:underline dark:text-[#ffe600]" :tabindex="5"
                                >S'inscrire
                            </TextLink>
                        </div>
                    </Form>
                </div>

                <div
                    class="flex w-full flex-col items-center justify-center bg-[var(--primary-blue)] p-6 text-white sm:rounded-tl-[90px] sm:rounded-bl-[90px] md:w-1/2 md:p-8 dark:bg-[#000]"
                >
                    <Link href="/" class="nav-link">
                        <img src="assets/boristech.jpg" alt="Boris Tech" class="z-1000 h-[100px] w-[100px] rounded-full object-cover" />
                    </Link>
                    <h2 class="mb-4 text-2xl font-bold">Hello, Friend!</h2>
                    <p class="mb-6 text-center">Connectez-vous avec vos identifiants pour accéder à votre compte.</p>
                </div>
            </div>
        </div>
    </AuthBase>
</template>
