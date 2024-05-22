<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from 'primevue/button';

defineOptions({ layout: AppLayout})
</script>

<template>
  <form @submit.prevent="router.post('/logout')">
    <div class="text-right">
      <Button class="right-2" type="submit" label="Logout"/>
    </div>
  </form>
  <div class="place-items-center">
    <h1 class="text-5xl text text-center text-green-300">
      Welcome to Job Listings Board!
    </h1>
  </div>
  <section class="text-gray-600 body-font border-b border-gray-100">
    <div class="container mx-auto flex flex-col px-5 pt-16 pb-8 justify-center items-center">
      <div class="w-full md:w-2/3 flex flex-col items-center text-center">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-green-300">Top jobs in the industry</h1>
        <p class="mb-8 leading-relaxed text-white">Whether you're looking for fresh or experienced talent, our posting board will get you what you need. Post any job listing to expand your business!</p>
        <form class="flex w-full justify-center items-end" action="{{ route('listings.index') }}" method="get">
          <div class="relative mr-4 w-full lg:w-1/2 text-left">
            <input type="text" id="s" name="s" value="Search for Jobs" class="w-full bg-gray-100 bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
          <button class="inline-flex text-black bg-green-300 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Search</button>
        </form>
      </div>
    </div>
  </section>
</template>
