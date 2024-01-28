<!-- src/pages/LoginPage.vue -->

<template>
  <!-- Design template by Joabson Arley
   https://github.com/Joabsonlg/quasar-template-->

  <q-card class="q-ma-xl">
    <div class="row">
      <div class="col-0 col-sm-5 bg-dark rounded-left-borders xs-hide">
        <div
          class="row full-width q-px-xl q-pb-xl full-height flex flex-center"
        >
          <div class="">
            <div
              class="text-h4 text-uppercase text-white fredoka"
              style="min-width: 220px"
            >
              Bienvenido!
            </div>
            <div class="text-white q-my-sm text-subtitle1">
              ¡Inicie sesión en su cuenta para comenzar!
            </div>
            <div class="text-white q-my-sm text-subtitle1">
              <p class="logo">INFO EDUCA-PUNO</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-7">
        <div class="row q-ml-sm q-mt-sm sm-and-up-hide">
          <div class="col-12 fredoka text-subtitle1">
            <router-link class="text-dark" style="text-decoration: none" to="/">
              Shark
            </router-link>
          </div>
        </div>
        <div class="row q-pa-sm-sm q-pa-md">
          <div class="col-12">
            <q-card-section>
              <div class="q-mb-xl">
                <div class="flex justify-center">
                  <div
                    class="text-h4 text-uppercase q-my-none text-weight-bold text-dark fredoka"
                  >
                    Iniciar sesión
                  </div>
                </div>
              </div>

              <q-form ref="form" class="q-gutter-md" @submit="submit">
                <q-input
                  v-model="user.email"
                  color="dark"
                  label="Correo"
                  name="Email"
                />

                <q-input
                  v-model="user.password"
                  color="dark"
                  label="Contraseña"
                  name="password"
                  type="password"
                />

                <div>
                  <q-btn
                    class="full-width fredoka"
                    color="dark"
                    label="Login"
                    rounded
                    type="submit"
                  ></q-btn>

                  <div class="q-mt-lg">
                    <div class="q-mt-sm">
                      ¿Aún no tienes una cuenta?
                      <router-link class="text-primary" to="/register"
                        >Registrarse</router-link
                      >
                    </div>
                  </div>
                  <q-btn
                    class="full-width fredoka"
                    color="primary"
                    label="Login with Facebook"
                    rounded
                    @click="loginWithFacebook"
                  >
                  </q-btn>
                </div>
              </q-form>
            </q-card-section>
          </div>
        </div>
      </div>
    </div>
  </q-card>
</template>

<script setup>
import { ref, reactive } from "vue";

import { login, loginWithFacebook } from "src/firebase/firebase-login";
import { useRouter } from "vue-router";

const $router = useRouter();

const user = reactive({
  email: null,
  password: null,
});

const form = ref(null);
const router = useRouter();
const submit = async () => {
  if (form.value.validate()) {
    try {
      await login(user); // Lógica de inicio de sesión aquí
      console.log("Inicio de sesión exitoso"); // Verificación en consola
      // Redirección después del inicio de sesión exitoso
      $router.push("/app"); // Asegúrate de que $router esté disponible en el contexto
    } catch (err) {
      console.error("Error en el inicio de sesión:", err); // Manejo de errores
    }
  }
};
const handleFacebookLogin = async () => {
  try {
    await loginWithFacebook();
    router.push("/app");
  } catch (err) {
    // Manejar el error, si es necesario
  }
};
</script>
<style>
.logo {
  font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
  font-size: 40px;
}
</style>
