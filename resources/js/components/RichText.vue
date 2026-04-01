<script setup>
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';
import StarterKit from '@tiptap/starter-kit';
import { EditorContent, useEditor } from '@tiptap/vue-3';
import { Bold, Heading2, Image as ImageIcon, Italic, Link as LinkIcon, List, Redo, Undo } from 'lucide-vue-next';

const props = defineProps({
    modelValue: String,
    label: String,
    error: String,
});

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit, Image, Link.configure({ openOnClick: false }), Placeholder.configure({ placeholder: 'Rédigez votre article ici...' })],
    editorProps: {
        attributes: {
            class: 'prose dark:prose-invert max-w-none focus:outline-none min-h-[200px] p-4 border rounded-b-lg dark:border-gray-600 dark:bg-[#2A2A2A]',
        },
    },
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML());
    },
});

const addLink = () => {
    const url = window.prompt('URL du lien :');
    if (url) editor.value.chain().focus().setLink({ href: url }).run();
};

const addImage = () => {
    const url = window.prompt("URL de l'image :");
    if (url) editor.value.chain().focus().setImage({ src: url }).run();
};
</script>

<template>
    <div class="editor-container">
        <label v-if="label" class="mb-2 block font-semibold text-gray-700 dark:text-[var(--dark-gold)]">
            {{ label }}
        </label>

        <div v-if="editor" class="toolbar flex flex-wrap gap-1 rounded-t-lg border border-b-0 bg-gray-50 p-2 dark:border-gray-600 dark:bg-zinc-800">
            <button
                type="button"
                @click="editor.chain().focus().toggleBold().run()"
                :class="{ 'is-active': editor.isActive('bold') }"
                class="btn-tool"
            >
                <Bold :size="18" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'is-active': editor.isActive('italic') }"
                class="btn-tool"
            >
                <Italic :size="18" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
                class="btn-tool"
            >
                <Heading2 :size="18" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'is-active': editor.isActive('bulletList') }"
                class="btn-tool"
            >
                <List :size="18" />
            </button>

            <div class="divider"></div>

            <button type="button" @click="addLink" :class="{ 'is-active': editor.isActive('link') }" class="btn-tool"><LinkIcon :size="18" /></button>
            <button type="button" @click="addImage" class="btn-tool"><ImageIcon :size="18" /></button>

            <div class="divider"></div>

            <button type="button" @click="editor.chain().focus().undo().run()" class="btn-tool"><Undo :size="18" /></button>
            <button type="button" @click="editor.chain().focus().redo().run()" class="btn-tool"><Redo :size="18" /></button>
        </div>

        <editor-content :editor="editor" />

        <p v-if="error" class="mt-1 text-sm text-red-500">{{ error }}</p>
    </div>
</template>

<style scoped>
@reference "../../css/app.css"
.btn-tool {
    @apply rounded p-2 text-gray-600 transition-colors hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-zinc-700;
}
.btn-tool.is-active {
    @apply bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-200;
}
.divider {
    @apply mx-1 h-6 w-[1px] self-center bg-gray-300 dark:bg-gray-600;
}
/* Style pour le Placeholder */
:deep(.tiptap p.is-editor-empty:first-child::before) {
    content: attr(data-placeholder);
    float: left;
    color: #adb5bd;
    pointer-events: none;
    height: 0;
}
</style>
