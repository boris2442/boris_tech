<script setup>
import ContactNav from '@/components/frontend/ContactNav.vue';
import ScroolProgress from '@/components/frontend/ScrollProgress.vue';
import SocialMedia from '@/components/frontend/SocialMedia.vue';
import ThemeToggle from '@/components/frontend/ThemeToggle.vue';
import { about, contact, home } from '@/routes';
import blogFrontend from '@/routes/blogFrontend';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faEnvelope,
    faFileAlt,
    faInfoCircle,
    faNewspaper,
    faRightToBracket,
    faSignOutAlt,
    faTachometerAlt,
    faUserCircle,
    faUserPlus,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { BookOpen } from 'lucide-vue-next';
// import ThemeToggle from '@/components/frontend/ThemeToggle.vue';

import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

library.add(faUserCircle, faSignOutAlt, faTachometerAlt, faEnvelope, faInfoCircle, faRightToBracket, faUserPlus, faFileAlt, faNewspaper);

const props = defineProps({ auth: Object });
const isAuthenticated = computed(() => !!props.auth?.user);

import { usePage } from '@inertiajs/vue3';

const page = usePage();

const isActive = (route) => {
    return page.url === route;
};
</script>

<template>
    <header>
        <ScroolProgress />

        <nav class="bg-[var(--primary-blue)] shadow-md dark:bg-[var(--dark-background)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <Link prefetch :href="home()" preserve-scroll preserve-state>
                            <img
                                src="/assets/boristech.jpg"
                                loading="lazy"
                                alt="Boris Tech"
                                class="h-10 rounded border-2 border-solid border-gray-400 object-contain"
                            />
                        </Link>
                    </div>

                    <!-- Navbar Links Desktop -->
                    <!-- Navbar Links Desktop -->
                    <div class="hidden flex-1 justify-center space-x-8 md:flex">
                        <Link prefetch :href="about()" class="nav-item group flex flex-col items-center">
                            <FontAwesomeIcon
                                icon="info-circle"
                                class="text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                            />
                            <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)]">À propos</span>
                        </Link>

                        <Link prefetch :href="contact()" class="nav-item group flex flex-col items-center">
                            <FontAwesomeIcon
                                icon="envelope"
                                class="text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                            />
                            <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)]">Contact</span>
                        </Link>
                        <Link prefetch :href="blogFrontend.index().url" class="nav-item group flex flex-col items-center">
                            <BookOpen
                                class="h-5 w-5 text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                            />

                            <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)]">Blogs</span>
                        </Link>

                        <template v-if="isAuthenticated">
                            <Link prefetch href="/dashboard" class="nav-item group flex flex-col items-center">
                                <FontAwesomeIcon
                                    icon="tachometer-alt"
                                    class="text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)]"
                                />
                                <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                                    >Dashboard</span
                                >
                            </Link>

                            <Link prefetch href="/logout" method="post" class="nav-item group flex flex-col items-center">
                                <FontAwesomeIcon
                                    icon="sign-out-alt"
                                    class="text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                                />
                                <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)]">Déconnexion</span>
                            </Link>
                        </template>

                        <template v-else>
                            <Link prefetch href="/login" class="nav-item group flex flex-col items-center">
                                <FontAwesomeIcon
                                    icon="right-to-bracket"
                                    class="text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                                />
                                <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)]">Se connecter</span>
                            </Link>

                            <Link prefetch href="/register" class="nav-item group flex flex-col items-center">
                                <FontAwesomeIcon
                                    icon="user-plus"
                                    class="text-2xl transition-transform duration-200 group-hover:scale-110 md:text-[var(--dark-gold)] dark:text-[var(--dark-gold)]"
                                />
                                <span class="mt-1 transition-colors duration-200 group-hover:text-[var(--dark-gold)]">S’inscrire</span>
                            </Link>
                        </template>
                    </div>

                    <div class="flex w-full items-center justify-around md:hidden">
                        <Link prefetch :href="about()" class="mobile-nav-item text-[var(--dark-gold)]">
                            <FontAwesomeIcon icon="info-circle" class="text-xl" />
                            <span>À propos</span>
                        </Link>

                        <Link prefetch :href="contact()" class="mobile-nav-item text-[var(--dark-gold)]">
                            <FontAwesomeIcon icon="envelope" class="text-xl" />
                            <span>Contact</span>
                        </Link>

                        <Link prefetch :href="blogFrontend.index().url" class="mobile-nav-item text-[var(--dark-gold)]">
                            <BookOpen class="h-5 w-5" />
                            <span>Blogs</span>
                        </Link>

                        <template v-if="isAuthenticated">
                            <Link prefetch href="/dashboard" class="mobile-nav-item text-[var(--dark-gold)]">
                                <FontAwesomeIcon icon="tachometer-alt" class="text-xl" />
                                <span>Dashboard</span>
                            </Link>

                            <Link prefetch href="/logout" method="post" class="mobile-nav-item text-[var(--dark-gold)]">
                                <FontAwesomeIcon icon="sign-out-alt" class="text-xl" />
                                <span>Sortir</span>
                            </Link>
                        </template>

                        <template v-else>
                            <Link prefetch href="/login" class="mobile-nav-item text-[var(--dark-gold)]">
                                <FontAwesomeIcon icon="right-to-bracket" class="text-xl" />
                                <span>Login</span>
                            </Link>

                            <Link prefetch href="/register" class="mobile-nav-item text-[var(--dark-gold)]">
                                <FontAwesomeIcon icon="user-plus" class="text-xl" />
                                <span>Inscription</span>
                            </Link>
                        </template>
                    </div>

                    <div class="md:block">
                        <ThemeToggle />
                    </div>
                </div>
            </div>

            <ContactNav />
        </nav>

        <!-- Social Media -->
        <div class="mt-4 flex justify-center px-4">
            <SocialMedia />
        </div>
    </header>
</template>

<style scoped>
.nav-item span {
    color: var(--dark-white);
    text-align: center;
    font-size: 0.875rem;
}
.nav-item:hover span {
    color: var(--dark-gold);
}

.nav-item span {
    color: var(--dark-white);
    text-align: center;
    font-size: 0.875rem;
    transition: 0.2s;
}

.nav-item.active span {
    color: var(--dark-gold);
}

.nav-item.active svg {
    color: var(--dark-gold) !important;
}

.nav-item:hover span {
    color: var(--dark-gold);
}

.nav-item svg {
    transition: 0.2s;
}

.nav-item.active {
    opacity: 0.6; /* légère opacité */
}

.nav-item {
    transition: opacity 0.25s ease;
}

.mobile-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 0.65rem; /* très petit comme LinkedIn */
    line-height: 1;
}

.mobile-nav-item span {
    margin-top: 2px;
    font-size: 12px;
    opacity: 0.85;
}
</style>
