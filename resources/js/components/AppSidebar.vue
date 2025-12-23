<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import description from '@/routes/admin/description';
import newsletter from '@/routes/admin/newsletter';
import categories from '@/routes/categories';
import contacts from '@/routes/contacts';
import dashboardAdmin from '@/routes/dashboard';
import posts from '@/routes/posts';
import products from '@/routes/products';
import users from '@/routes/users';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, FileText, Home, Layers, LayoutGrid, List, Mail, MessageCircleMore, Store } from 'lucide-vue-next';
import { computed } from 'vue';
import AppLogo from './AppLogo.vue';
const page = usePage();
const user = computed(() => page.props.auth?.user);

const mainNavItems: NavItem[] = [
    // Liens visibles pour tous
    {
        title: 'Accueil',
        href: '/',
        icon: Home,
    },
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },

    // Liens visibles uniquement pour les admins
    ...(user.value?.role === 'admin'
        ? [
              {
                  title: 'Users',
                  href: users.index().url,
                  icon: BookOpen,
              },
              {
                  title: 'Graphiques ++',
                  href: dashboardAdmin.admin().url,
                  icon: LayoutGrid,
              },

              {
                  title: 'Messages ',
                  href: contacts.index().url,
                  icon: MessageCircleMore,
              },
              {
                  title: 'Products',
                  href: products.index().url,
                  icon: Store,
              },
              {
                  title: 'Categories',
                  href: categories.index().url,
                  icon: List,
              },

              {
                  title: 'Descriptions',
                  href: description.index().url,
                  icon: FileText,
              },
              {
                  title: 'NewsLetters',
                  href: newsletter.index().url,
                  icon: Mail,
              },
              {
                  title: 'Posts',
                  href: posts.index().url,
                  icon: Layers,
              },
          ]
        : []),
];

const footerNavItems: NavItem[] = [];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()" prefetch>
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
