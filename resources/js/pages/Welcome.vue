<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="max-w-4xl mx-auto p-8">
        <div class="flex gap-4">
            <Link href="/tasks/create" class="px-2 py-2 bg-black text-white rounded">
                Add Task
            </Link>
            <Link href="/technicians/create" class="px-4 py-2 bg-gray-500 text-white rounded">
                Add Technician
            </Link>
        </div>
        <div class="pt-8">
        <h2 class="text-2xl font-semibold mb-6">Task Scheduling</h2>

<!-- Success Message -->
  <div
    v-if="$page.props.flash.success"
    class="p-4 mb-4 bg-green-100 text-green-800 border-l-4 border-green-400 rounded-lg"
  >
    <strong>Success!</strong> {{ $page.props.flash.success }}
  </div>

  <!-- Error Message -->
  <div
    v-if="$page.props.flash.error"
    class="p-4 mb-4 bg-red-100 text-red-800 border-l-4 border-red-400 rounded-lg"
  >
    <strong>Error!</strong> {{ $page.props.flash.error }}
  </div>
        <!-- Import and use TaskList component -->
            <Tasks :tasks="tasks" />
            </div>

    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Tasks from './partials/Tasks.vue';

defineProps({
  tasks: Array,  // Array of skill objects passed from the backend
});

</script>
