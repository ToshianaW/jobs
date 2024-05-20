<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Panel from 'primevue/panel';
import InputText from "primevue/inputtext";
import Button from "primevue/button";

const form = useForm({
  email: null,
  password: null,
})
</script>

<template>
  <div class="grid h-screen place-content-center">
    <Panel>
      <form @submit.prevent="form.post('/login')">
        <div class="flex flex-col gap-1">
          <label
              for="email"
          >
            Email
          </label>
          <InputText
              type="email"
              v-model="form.email"
              id="email"
          />
          <small v-if="form.errors.email" class="text-red-500">
            {{ form.errors.email }}
          </small>
        </div>
        <div class="flex flex-col gap-1">
          <label
              for="password"
          >
            Password
          </label>
          <InputText
              type="password"
              v-model="form.password"
              id="first_name"
          />
          <small v-if="form.errors.password" class="text-red-500">
            {{ form.errors.password }}
          </small>
        </div>
        <div class="flex justify-end mt-3">
          <Button type="submit" label="Login" />
        </div>
      </form>
    </Panel>
  </div>
</template>