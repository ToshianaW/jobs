<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Panel from 'primevue/panel';
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import { defineProps } from 'vue';

const props = defineProps({
  listings: Array
});

const form = useForm({
  title: null,
  company: null,
  description: null,
});

</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen space-y-6">
    <panel class="w-96 p-6">
      <h2 class="text-2xl mb-4">Add Listing</h2>
      <form @submit.prevent="form.post('/listings')" class="space-y-4">
        <div class="flex flex-col gap-1">
          <label for="title">Title</label>
          <InputText type="text" v-model="form.title" id="title" />
          <small v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</small>
        </div>
        <div class="flex flex-col gap-1">
          <label for="company">Company</label>
          <InputText type="text" v-model="form.company" id="company" />
          <small v-if="form.errors.company" class="text-red-500">{{ form.errors.company }}</small>
        </div>
        <div class="flex flex-col gap-1">
          <label for="description">Description</label>
          <InputText type="text" v-model="form.description" id="description" />
          <small v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</small>
        </div>
        <div class="flex justify-end mt-3">
          <Button type="submit" label="Submit" />
        </div>
      </form>
    </panel>
  </div>
</template>