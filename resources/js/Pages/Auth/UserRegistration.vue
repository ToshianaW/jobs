<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Panel from 'primevue/panel';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const form = useForm({
  first_name: null,
  last_name: null,
  email: null,
  password: null,
  password_confirmation: null,
})
</script>

<template>
  <div class="grid h-screen place-content-center">
    <Panel>
      <form @submit.prevent="form.post('/register')">
        <div class="flex flex-col gap-1">
          <label
              for="first_name"
          >
            First Name
          </label>
          <InputText
              type="text"
              v-model="form.first_name"
              id="first_name"
          />
          <small v-if="form.errors.first_name" class="text-red-500">
            {{ form.errors.first_name }}
          </small>
        </div>
        <div class="flex flex-col gap-1">
          <label
              for="last_name"
          >
            Last Name
          </label>
          <InputText
              type="text"
              v-model="form.last_name"
              id="last_name"
          />
          <small v-if="form.errors.last_name" class="text-red-500">
            {{ form.errors.last_name }}
          </small>
        </div>
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
        <div class="flex flex-col gap-1">
          <label
              for="password_confirmation"
          >
            Password Confirmation
          </label>
          <InputText
              type="password"
              v-model="form.password_confirmation"
              id="first_name"
          />
          <small v-if="form.errors.password_confirmation" class="text-red-500">
            {{ form.errors.password_confirmation }}
          </small>
        </div>
        <div class="flex justify-end mt-3">
          <Button type="submit" label="Submit" />
        </div>
      </form>
    </Panel>
  </div>
</template>