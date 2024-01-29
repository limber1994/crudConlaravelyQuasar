<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated class="custom-header">
      <q-toolbar>
        <q-toolbar-title> INFO EDUCA-PUNO </q-toolbar-title>
        <div
          v-if="$q.screen.gt.sm"
          class="GL__toolbar-link q-ml-xs q-gutter-md text-body2 text-weight-bold row items-center no-wrap"
        >
          <a href="app7" class="text-white">
            <q-btn color="red" icon="home" label="Inicio" />
          </a>
          <a href="catalogo" class="text-white">
            <q-btn color="red" label="Catalogo" />
          </a>
          <a href="tests" class="text-white">
            <q-btn color="red" label="Test" />
          </a>
          <a href="usuarios" class="text-white">
            <q-btn color="red" label="Usuarios" />
          </a>
          <a href="instituciones" class="text-white">
            <q-btn color="red" label="Instituciones" />
          </a>
        </div>
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
