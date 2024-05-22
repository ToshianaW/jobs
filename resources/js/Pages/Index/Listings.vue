<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import AddListing from '@/Pages/Auth/AddListing.vue';
import { defineOptions } from 'vue';
import { defineProps } from 'vue';


const props = defineProps({
  listings: Array
});
defineOptions({ layout: AppLayout });
</script>

<template>
  <AddListing :listings="props.listings"/>
</template>