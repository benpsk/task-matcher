<template>
  <div class="max-w-4xl mx-auto p-8">
    <h2 class="text-2xl font-semibold mb-6">Create Task</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <!-- Title Input -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input
          type="text"
          v-model="form.title"
          id="title"
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter task title"
        >
      </div>

        <!-- Skill ID Dropdown -->
        <div>
        <label for="required_skill_id" class="block text-sm font-medium text-gray-700">Required Skill</label>
        <select
            v-model="form.required_skill_id"
            id="required_skill_id"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="" disabled selected>Select a skill</option>
            <!-- Loop through the skills passed from the backend -->
            <option v-for="skill in skills" :key="skill.id" :value="skill.id">
            {{ skill.name }}
            </option>
        </select>
        </div>

      <!-- Urgency Input -->
      <div>
        <label for="urgency" class="block text-sm font-medium text-gray-700">Urgency</label>
        <select
          v-model="form.urgency"
          id="urgency"
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option value="High">High</option>
          <option value="Medium">Medium</option>
          <option value="Low">Low</option>
        </select>
      </div>

      <!-- Duration Input -->
      <div>
        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (1-3 days)</label>
        <input
          type="number"
          v-model="form.duration"
          id="duration"
          min="1" max="3"
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter task duration"
        >
      </div>

      <!-- Required Technicians Input -->
      <div>
        <label for="required_technicians" class="block text-sm font-medium text-gray-700">Required Technicians (1-3)</label>
        <input
          type="number"
          v-model="form.required_technicians"
          id="required_technicians"
          min="1" max="3"
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter number of technicians"
        >
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
          Create Task
        </button>
      </div>
    </form>

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
defineProps({
  skills: Array,  // Declare that 'skills' is passed as an array from the backend
});
interface TaskForm {
  title: string;
  required_skill_id: number;
  urgency: 'High' | 'Medium' | 'Low';
  duration: number;
  required_technicians: number;
}

const form = ref<TaskForm>({
  title: '',
  required_skill_id: 0,
  urgency: 'High',
  duration: 1,
  required_technicians: 1,
});

const errors = ref<Record<string, string[]>>({});

const submitForm = async () => {
  try {
    await router.post('/tasks', form.value, {
      onError: (errorMessages) => {
        errors.value = errorMessages;
      },
    });
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};
</script>
