<template>
    <!-- List of Tasks -->
    <div v-if="tasks.length" class="space-y-4">
      <div
        v-for="task in tasks"
        :key="task.id"
        class="border p-4 rounded-lg shadow-sm"
      >
        <h4 class="text-lg font-medium">Task: {{ task.title }}</h4>
        <p>Required Skill: {{ task.skill.name }}</p>
        <p>Urgency: {{ task.urgency }}</p>
        <p>Duration: {{ task.duration }} days</p>
        <p>Required Technicians: {{ task.required_technicians }}</p>

        <!-- Display assigned technicians for this task -->
      <div v-if="task.assign_tasks.length">
        <h5 class="mt-4 text-md font-semibold">Assigned Technicians:</h5>
        <ul class="list-disc pl-5">
          <li v-for="assign in task.assign_tasks" :key="assign.technician_id">
            <p>
              Technician: {{ assign.technician.name }} <br />
              Assigned Days: {{ JSON.parse(assign.assigned_days).join(', ') }}
            </p>
          </li>
        </ul>
      </div>

        <!-- Match Task Button -->
        <button
          @click="matchTask(task.id)"
          class="mt-4 py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          Match Task
        </button>
      </div>
    </div>

    <!-- Success/Failure Message -->
    <div v-if="message" class="mt-6 text-green-500">
      {{ message }}
    </div>
    <div v-if="error" class="mt-6 text-red-500">
      {{ error }}
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

defineProps({
  tasks: Array,  // Array of skill objects passed from the backend
});
const message = ref('');
const error = ref('');

const matchTask = async (taskId: number) => {
  router.post('/assign-task', { task_id: taskId });
};
</script>

