<template>
  <q-layout class="bbg-melon-pink">
    <q-header
      elevated
      class="text-white"
      style="background: #312d2d"
      height-hint="61.59"
    >
      <q-toolbar class="q-py-sm q-px-md">
        <div class="logo-container">
          <img src="src/assets/logolibro.png" />
        </div>
        <q-select
          ref="search"
          dark
          dense
          standout
          use-input
          hide-selected
          class="GL__toolbar-select"
          color="black"
          :stack-label="false"
          label="Search or jump to..."
          v-model="text"
          :options="filteredOptions"
          @filter="filter"
          style="width: 300px"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section>
                <div class="text-center">
                  <q-spinner-pie color="grey-5" size="24px" />
                </div>
              </q-item-section>
            </q-item>
          </template>

          <template v-slot:option="scope">
            <q-item v-bind="scope.itemProps" class="GL__select-GL__menu-link">
              <q-item-section side>
                <q-icon name="collections_bookmark" />
              </q-item-section>
              <q-item-section>
                <q-item-label>{{ scope.opt.label }}</q-item-label>
              </q-item-section>
              <q-item-section side :class="{ 'default-type': !scope.opt.type }">
                <q-btn
                  outline
                  dense
                  no-caps
                  text-color="blue-grey-5"
                  size="12px"
                  class="bg-grey-1 q-px-sm"
                >
                  {{ scope.opt.type || "Jump to" }}
                  <q-icon name="subdirectory_arrow_left" size="14px" />
                </q-btn>
              </q-item-section>
            </q-item>
          </template>
        </q-select>

        <q-space />

        <div class="q-pl-sm q-gutter-sm row items-center no-wrap">
          <q-btn
            v-if="$q.screen.gt.xs"
            dense
            flat
            round
            size="sm"
            icon="notifications"
          />
          <q-btn v-if="$q.screen.gt.xs" dense flat>
            <div class="row items-center no-wrap">
              <q-icon name="add" size="20px" />
              <q-icon
                name="arrow_drop_down"
                size="16px"
                style="margin-left: -2px"
              />
            </div>
            <q-menu auto-close>
              <q-list dense style="min-width: 100px"> </q-list>
            </q-menu>
          </q-btn>

          <q-btn dense flat no-wrap>
            <q-avatar rounded size="20px">
              <img src="https://cdn.quasar.dev/img/avatar3.jpg" />
            </q-avatar>
            <q-icon name="arrow_drop_down" size="16px" />

            <q-menu auto-close>
              <q-list dense>
                <q-item class="GL__menu-link-signed-in">
                  <q-item-section>
                    <div>Signed in as <strong>Mary</strong></div>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />

      <!-- Aquí puedes agregar el contenido específico del cuerpo de la página -->
      <div class="row red-background">
        <!-- Contenedor para la imagen y el texto -->
        <div class="col content-with-image">
          <div>
            <h1>
              <span class="orange-text">Aplica</span>
              <span class="black-text"> nuestro Test</span>
              <span class="orange-text"> Vocacional</span>
            </h1>
            <h5>
              <span class="silver-text">
                La mejor plataforma para buscar opciones para tu futuro
              </span>
            </h5>
            <a
              class="boton-test"
              href="https://www.elegircarrera.net/test-vocacional/"
            >
              <q-btn
                size="22px"
                unelevated
                rounded
                color="red"
                label="Aplica nuestro test"
              />
            </a>
          </div>
          <!-- Imagen a la derecha del texto -->
        </div>
        <div class="col">
          <img
            class="alumnos"
            src="src/assets/alumnos.jfif"
            alt="Descripción de la imagen"
          />
        </div>
      </div>
    </q-page-container>

    <!-- Nuevo pie de página (footer) -->
    <q-footer
      elevated
      class="text-white"
      style="background: #312d2d"
      height-hint="61.59"
    >
      <div class="row" id="pie">
        <div class="col">Su cuenta</div>
        <div class="col">Busca tu carrera</div>
        <div class="col">Visita nuestras redes</div>
      </div>
      <div class="row" id="pie2">
        <div class="col">informacion personal</div>
        <div class="col">Universidades e institutos</div>
        <div class="col social-icons">
          <q-icon name="fab fa-facebook" />
          <q-icon name="fab fa-twitter" />
          <q-icon name="fab fa-instagram" />
        </div>
      </div>
    </q-footer>
  </q-layout>
</template>

<script>
import { ref } from "vue";
import { fabGithub } from "@quasar/extras/fontawesome-v6";

const stringOptions = [
  "quasarframework/quasar",
  "quasarframework/quasar-awesome",
];

export default {
  name: "MyLayout",

  setup() {
    const text = ref("");
    const options = ref(null);
    const filteredOptions = ref([]);
    const search = ref(null); // $refs.search

    function filter(val, update) {
      if (options.value === null) {
        // load data
        setTimeout(() => {
          options.value = stringOptions;
          search.value.filter("");
        }, 2000);
        update();
        return;
      }

      if (val === "") {
        update(() => {
          filteredOptions.value = options.value.map((op) => ({ label: op }));
        });
        return;
      }

      update(() => {
        filteredOptions.value = [
          {
            label: val,
            type: "In this repository",
          },
          {
            label: val,
            type: "All GitHub",
          },
          ...options.value
            .filter((op) => op.toLowerCase().includes(val.toLowerCase()))
            .map((op) => ({ label: op })),
        ];
      });
    }

    return {
      fabGithub,

      text,
      options,
      filteredOptions,
      search,

      filter,
    };
  },
};
</script>
<style>
.red-background {
  background-color: #edd3ee;
  padding: 20px; /* Ajusta el espaciado según tus preferencias */
  color: #ff7426; /* Cambia el color del texto para que sea legible sobre fondo rojo */
  min-height: calc(100vh - 60px);
}
quasar :-moz-drag-over .content-with-image {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.alumnos {
  height: 500px;
  width: 700px; /* Ajusta el tamaño de la imagen según tus necesidades */
}

.bg-melon-pink {
  background-color: #ff6b6b; /* Puedes ajustar este color según tus preferencias */
}
.orange-text {
  font-weight: bold;
  font-family: "Roboto", sans-serif;
  color: orange;
}

.black-text {
  font-weight: bold;
  color: black;
}
.silver-text {
  color: rgb(66, 63, 63);
}
.logo-container {
  width: 50px;
  height: 50px;
}

.logo-container img {
  width: 100%; /* Esto hará que la imagen ocupe el 100% del ancho del contenedor */
  height: 100%; /* Esto hará que la imagen ocupe el 100% de la altura del contenedor */
  object-fit: cover; /* Esto ajustará la imagen para cubrir completamente el contenedor */
}
.boton-test {
  margin-left: 150px;
}
#pie {
  font-size: 30px;
  font-weight: bold;
  font-family: Arial, Helvetica, sans-serif;
  margin-left: 200px;
}
#pie2 {
  font-size: 20px;
  font-family: Arial, Helvetica, sans-serif;
  margin-left: 200px;
}
.social-icons {
  font-size: 50px;
}
</style>
