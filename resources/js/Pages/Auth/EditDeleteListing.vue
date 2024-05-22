<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import Panel from 'primevue/panel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

interface Listing {
  id: number;
  title: string;
  company: string;
  description: string;
  user_id: number;
}

const props = defineProps<{ listing: Listing }>();

const form = useForm({
  title: props.listing.title,
  company: props.listing.company,
  description: props.listing.description,
});

const updateListing = () => {
  form.put(`/listings/${props.listing.id}`, {
    onSuccess: () => router.visit('/listings'),
  });
};

const deleteListing = () => {
  if (confirm('Are you sure you want to delete this listing?')) {
    form.delete(`/listings/${props.listing.id}`, {
      onSuccess: () => router.visit('/listings'),
    });
  }
};
</script>

<template>
  <Panel>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="text-2xl">Edit Listing</h2>
        <Button label="Delete" @click="deleteListing" />
      </div>
    </template>
    <form @submit.prevent="updateListing">
      <div class="space-y-4">
        <div>
          <label for="title" class="block font-medium text-gray-700">Title</label>
          <InputText id="title" v-model="form.title" class="w-full" />
          <div v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</div>
        </div>
        <div>
          <label for="company" class="block font-medium text-gray-700">Company</label>
          <InputText id="company" v-model="form.company" class="w-full" />
          <div v-if="form.errors.company" class="text-red-500">{{ form.errors.company }}</div>
        </div>
        <div>
          <label for="description" class="block font-medium text-gray-700">Description</label>
          <InputText id="description" v-model="form.description" class="w-full" />
          <div v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</div>
        </div>
        <div class="flex justify-end">
          <Button type="submit" label="Update" />
        </div>
      </div>
    </form>
  </Panel>
</template>