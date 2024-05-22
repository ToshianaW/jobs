<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import AddListing from '@/Pages/Auth/AddListing.vue';
import EditDeleteListing from "@/Pages/Auth/EditDeleteListing.vue";
import { defineOptions, ref } from 'vue';
import { defineProps } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Button from 'primevue/button';

// Define the props to receive listings and auth data
const props = defineProps({
  listings: Array,
  auth: Object, // Authenticated user data
});
defineOptions({ layout: AppLayout });

// State to manage the currently edited listing
const currentlyEditing = ref(null);

// Method to delete a listing
const deleteListing = (id: number) => {
  if (confirm('Are you sure you want to delete this listing?')) {
    const form = useForm({});
    form.delete(`/listings/${id}`, {
      onSuccess: () => router.visit('/listings'),
    });
  }
};

// Method to set the currently editing listing
const editListing = (listing) => {
  currentlyEditing.value = listing;
};
</script>

<template>
  <div>
    <!-- Component to add a listing -->
    <AddListing :listings="props.listings" />

    <!-- Loop through the listings -->
    <div v-for="listing in props.listings" :key="listing.id" class="listing border p-4 mb-4">
      <h3 class="text-xl font-bold">{{ listing.title }}</h3>
      <p class="mb-2">{{ listing.description }}</p>

      <!-- Conditionally render the edit and delete buttons -->
      <div class="flex space-x-4">
        <Button
            v-if="props.auth.user.id === listing.user_id || props.auth.roles.includes('admin')"
            label="Edit"
            @click="editListing(listing)"
        />
        <Button
            v-if="props.auth.user.id === listing.user_id || props.auth.roles.includes('admin')"
            label="Delete"
            @click="deleteListing(listing.id)"
        />
      </div>

      <!-- Conditionally render the EditDeleteListing component -->
      <EditDeleteListing
          v-if="currentlyEditing && currentlyEditing.id === listing.id"
          :listing="currentlyEditing"
      />
    </div>
  </div>
</template>

