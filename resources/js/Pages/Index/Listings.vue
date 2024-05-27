<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import AddListing from '@/Pages/Auth/AddListing.vue';
import EditDeleteListing from "@/Pages/Auth/EditDeleteListing.vue";
import { defineOptions, ref } from 'vue';
import { defineProps } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Button from 'primevue/button';

// Define interfaces for the props
interface Listing {
  id: number;
  title: string;
  company: string;
  description: string;
  user_id: number;
}

interface Auth {
  user: {
    id: number;
    name: string;
    email: string;
  };
  roles: string[];
}

// Define the props to receive listings and auth data
const props = defineProps<{
  listings: Listing[];
  auth: Auth;
}>();
defineOptions({ layout: AppLayout });

// State to manage the currently edited listing
const currentlyEditing = ref<Listing | null>(null);

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
const editListing = (listing: Listing) => {
  currentlyEditing.value = listing;
};

// Method to handle job enquiry
const enquireAboutJob = (listing: Listing) => {
  // Trigger the event by making a POST request to the backend
  const form = useForm({});
  form.post(`/listings/${listing.id}/enquire`, {
    onSuccess: () => alert('Enquiry sent successfully!'),
  });
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
        <Button
          v-if="props.auth.user.id !- listing.user_id || props.auth.roles.includes ('admin')"
          label="Enquire"
          @click="enquireAboutJob(listing)"
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


