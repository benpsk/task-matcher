<template>
  <div class="max-w-4xl mx-auto p-8">
    <h2 class="text-2xl font-semibold mb-6">Create Technician</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <!-- Name Input -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input
          type="text"
          v-model="form.name"
          id="name"
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter technician name"
        />
      </div>

      <!-- Skills Dropdown (Multiple) -->
      <div>
        <label for="skill_ids" class="block text-sm font-medium text-gray-700">Skills</label>
        <select
          id="skill_ids"
          v-model="form.skill_ids"
          multiple
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option v-for="skill in skills" :key="skill.id" :value="skill.id">
            {{ skill.name }}
          </option>
        </select>
      </div>

      <!-- Submit Button -->
      <div>
        <button
          type="submit"
          class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          Create Technician
        </button>
      </div>
    </form>

    <!-- Error Display -->
    <div v-if="errors" class="text-red-500 mt-4">
      <ul>
        <li v-for="(message, field) in errors" :key="field">{{ message }}</li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

// Define the tasks prop
const props = defineProps({
  tasks: Array,  // The tasks array passed from the parent component
});

interface TechnicianForm {
  name: string;
  skill_ids: number[]; // Array of skill IDs
}

const form = ref<TechnicianForm>({
  name: '',
  skill_ids: [], // Array to store selected skill IDs
});

const errors = ref<Record<string, string[]>>({});

const submitForm = async () => {
  try {
    // Use Inertia's router to send the POST request to the backend
    await router.post('/technicians', form.value, {
      onError: (errorMessages) => {
        errors.value = errorMessages;
      },
    });
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};
</script>
