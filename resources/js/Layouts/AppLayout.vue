<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import Menubar from 'primevue/menubar';

const items = [
  { label: 'Home', command: () => router.get('/') },
  { label: 'About', command: () => router.get('/about') },
  { label: 'Listings', command: () => router.get('/listings')},
];
</script>

<template>
  <Menubar :model="items"/>
  <slot/>
</template>