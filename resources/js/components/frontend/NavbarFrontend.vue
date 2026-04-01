<script setup>
import SocialMedia from '@/components/frontend/SocialMedia.vue';
import ThemeToggle from '@/components/frontend/ThemeToggle.vue';
import { about, contact, home } from '@/routes';
import blogFrontend from '@/routes/blogFrontend';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faEnvelope,
    faFileAlt,
    faHome,
    faInfoCircle,
    faNewspaper,
    faRightToBracket,
    faSignOutAlt,
    faTachometerAlt,
    faUserCircle,
    faUserPlus,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { BookOpen } from 'lucide-vue-next';
import { computed } from 'vue';

library.add(faUserCircle, faSignOutAlt, faTachometerAlt, faEnvelope, faInfoCircle, faRightToBracket, faUserPlus, faFileAlt, faNewspaper, faHome);

const props = defineProps({ auth: Object });
const isAuthenticated = computed(() => !!props.auth?.user);

import { usePage } from '@inertiajs/vue3';
const page = usePage();
const isActive = (route) => page.url === route;
</script>

<template>
    <header>
        <!-- <ScroolProgress /> -->

        <!-- Navbar fixe -->
        <nav class="fixed top-0 left-0 z-50 w-full">
            <!-- Top bar -->
            <div class="flex h-12 items-center justify-between bg-[var(--primary-blue)] px-4 shadow-md dark:bg-[var(--dark-background)]">
                <div class="flex items-center space-x-4">
                    <Link prefetch :href="home()">
                        <img src="/assets/boristech.jpg" class="h-8 rounded border-2 border-solid border-gray-400 object-contain" />
                    </Link>
                    <!-- Ici tu peux ajouter recherche ou notifications -->
                </div>
                <div class="flex items-center space-x-4">
                    <ThemeToggle />
                    <SocialMedia />
                </div>
            </div>

            <!-- Second bar (desktop et mobile) -->
            <div class="border-t border-gray-500 bg-[var(--primary-blue)] shadow-md dark:bg-[var(--dark-background)]">
                <!-- Desktop menu -->
                <div class="hidden h-16 w-full items-center justify-around px-4 md:flex">
                    <Link prefetch :href="about()" class="nav-item" :class="{ active: isActive(about()) }">
                        <FontAwesomeIcon icon="info-circle" class="text-2xl" />
                        <span>À propos</span>
                    </Link>
                    <Link prefetch :href="contact()" class="nav-item" :class="{ active: isActive(contact()) }">
                        <FontAwesomeIcon icon="envelope" class="text-2xl" />
                        <span>Contact</span>
                    </Link>
                    <Link prefetch :href="blogFrontend.index().url" class="nav-item">
                        <BookOpen class="h-5 w-5 text-2xl" />
                        <span>Blogs</span>
                    </Link>

                    <template v-if="isAuthenticated">
                        <Link prefetch href="/dashboard" class="nav-item">
                            <FontAwesomeIcon icon="tachometer-alt" class="text-2xl" />
                            <span>Dashboard</span>
                        </Link>
                        <Link prefetch href="/logout" method="post" class="nav-item">
                            <FontAwesomeIcon icon="sign-out-alt" class="text-2xl" />
                            <span>Déconnexion</span>
                        </Link>
                    </template>

                    <template v-else>
                        <Link prefetch href="/login" class="nav-item">
                            <FontAwesomeIcon icon="right-to-bracket" class="text-2xl" />
                            <span>Se connecter</span>
                        </Link>
                        <Link prefetch href="/register" class="nav-item">
                            <FontAwesomeIcon icon="user-plus" class="text-2xl" />
                            <span>S’inscrire</span>
                        </Link>
                    </template>
                </div>

                <!-- Mobile menu (icônes + labels) -->
                <div class="flex h-16 items-center justify-around md:hidden">
                    <Link prefetch :href="home()" class="mobile-nav-item">
                        <FontAwesomeIcon icon="home" class="text-xl" />
                        <span>Accueil</span>
                    </Link>
                    <Link prefetch :href="about()" class="mobile-nav-item">
                        <FontAwesomeIcon icon="info-circle" class="text-xl" />
                        <span>À propos</span>
                    </Link>
                    <Link prefetch :href="contact()" class="mobile-nav-item">
                        <FontAwesomeIcon icon="envelope" class="text-xl" />
                        <span>Contact</span>
                    </Link>
                    <Link prefetch :href="blogFrontend.index().url" class="mobile-nav-item">
                        <BookOpen class="h-5 w-5" />
                        <span>Blogs</span>
                    </Link>

                    <template v-if="isAuthenticated">
                        <Link prefetch href="/dashboard" class="mobile-nav-item">
                            <FontAwesomeIcon icon="tachometer-alt" class="text-xl" />
                            <span>Dashboard</span>
                        </Link>
                        <Link prefetch href="/logout" method="post" class="mobile-nav-item">
                            <FontAwesomeIcon icon="sign-out-alt" class="text-xl" />
                            <span>Sortir</span>
                        </Link>
                    </template>

                    <template v-else>
                        <Link prefetch href="/login" class="mobile-nav-item">
                            <FontAwesomeIcon icon="right-to-bracket" class="text-xl" />
                            <span>Login</span>
                        </Link>
                        <Link prefetch href="/register" class="mobile-nav-item">
                            <FontAwesomeIcon icon="user-plus" class="text-xl" />
                            <span>Inscription</span>
                        </Link>
                    </template>
                </div>
            </div>

            <!-- Optionnel : ContactNav -->
            <!-- <ContactNav /> -->
        </nav>

        <!-- Compense la navbar fixe -->
        <div class="pt-[112px]"></div>
    </header>
</template>

<style scoped>
.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 0.875rem;
    color: var(--dark-white);
    transition: all 0.2s;
    position: relative;
}
.nav-item span {
    margin-top: 2px;
    font-size: 0.875rem;
    text-align: center;
}
.nav-item:hover,
.nav-item.active {
    color: var(--dark-gold);
}
.nav-item.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: var(--dark-gold);
    border-radius: 2px;
}

.mobile-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    color: var(--dark-white);
    transition: color 0.2s;
}
.mobile-nav-item span {
    margin-top: 2px;
    font-size: 10px;
    text-align: center;
}
.mobile-nav-item:hover,
.mobile-nav-item.active {
    color: var(--dark-gold);
}
</style>
