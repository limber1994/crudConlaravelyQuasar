<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated class="custom-header">
      <q-toolbar>
        <q-toolbar-title> INFO EDUCA-PUNO </q-toolbar-title>
        <q-btn flat @click="logout">Cerrar Sesión</q-btn>
      </q-toolbar>
    </q-header>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import signout from "src/firebase/firebase-signout";
import { useRouter } from "vue-router";

const router = useRouter();

const logout = () => {
  signout().then(() => {
    router.push("/login");
  });
};
</script>

<style scoped>
.custom-header {
  background-color: #312d2d; /* Cambia este valor al tono casi negro que desees */
}
</style>
