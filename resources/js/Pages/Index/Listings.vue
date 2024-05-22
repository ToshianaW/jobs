<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import AddListing from '@/Pages/Auth/AddListing.vue';
import EditDeleteListing from "@/Pages/Auth/EditDeleteListing.vue";
import { defineOptions, reactive, ref } from 'vue';
import { defineProps } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Button from 'primevue/button';

const props = defineProps({
  listings: Array
});
defineOptions({ layout: AppLayout });

// State to manage the currently edited listing
const currentlyEditing = ref(null);

const deleteListing = (id: number) => {
  if (confirm('Are you sure you want to delete this listing?')) {
    const form = useForm({});
    form.delete(`/listings/${id}`, {
      onSuccess: () => router.visit('/listings'),
    });
  }
};

const editListing = (listing) => {
  currentlyEditing.value = listing;
};
</script>

<template>
  <div>
    <AddListing :listings="props.listings"/>
    <div v-for="listing in props.listings" :key="listing.id" class="listing border p-4 mb-4">
      <h3 class="text-xl font-bold">{{ listing.title }}</h3>
      <p class="mb-2">{{ listing.description }}</p>
      <div class="flex space-x-4">
        <Button label="Edit" @click="editListing(listing)" />
        <Button label="Delete" @click="deleteListing(listing.id)" />
      </div>
      <!-- Conditionally render the EditDeleteListing component -->
      <EditDeleteListing v-if="currentlyEditing && currentlyEditing.id === listing.id" :listing="currentlyEditing" />
    </div>
  </div>
</template>
