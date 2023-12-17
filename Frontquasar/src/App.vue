<template>
  <div>
    <router-view />
  </div>
</template>
<script>
import { defineComponent, onBeforeMount } from "vue";
import { boot } from "quasar/wrappers";
import { initializeApp } from "firebase/app";
import FirebaseConfig from "src/firebase/firebaseConfig.js";
import { getAuth } from "firebase/auth";
import { getFirestore } from "firebase/firestore";

export default defineComponent({
  name: "App",
  setup() {
    boot(({ app }) => {
      const firebaseConfig = {
        // Tu configuración de Firebase
        apiKey: "AIzaSyCw672mNaRoVyT3v7_BjkG7RLaxpo8f4xA",
        authDomain: "login-8c904.firebaseapp.com",
        projectId: "login-8c904",
        storageBucket: "login-8c904.appspot.com",
        messagingSenderId: "628506505664",
        appId: "1:628506505664:web:7be0047fc7f5370e14d825",
      };

      const firebaseApp = initializeApp(firebaseConfig);
      const firebaseAuth = getAuth(firebaseApp);
      const firebaseFirestore = getFirestore(firebaseApp);

      app.config.globalProperties.$firebaseAuth = firebaseAuth;
      app.config.globalProperties.$firebaseFirestore = firebaseFirestore;

      onBeforeMount(() => {
        // Cualquier otra lógica que desees ejecutar antes de montar el componente
      });
    });
  },
});
</script>
