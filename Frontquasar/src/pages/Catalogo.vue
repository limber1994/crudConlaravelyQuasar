<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div class="q-pa-md row justify-center items-start q-gutter-md">
    <!--Paginación_ se modifico -> institucion in instituciones-->
    <q-card
      v-for="institucion in paginatedInstituciones"
      :key="institucion.id"
      class="my-card col-3"
      flat
      bordered
    >
      <q-card-section horizontal>
        <!-- Agrega este console.log para verificar la URL de la imagen -->

        <q-img :src="institucion.foto" style="width: 300px; height: 200px">
          <div
            class="absolute-bottom text-h6"
            style="width: 100%; text-align: center"
          >
            {{ institucion.nombre }}
          </div>
        </q-img>

        <q-card-actions vertical class="justify-around">
          <q-btn flat round color="red" icon="favorite" />
          <q-btn flat round color="accent" icon="bookmark" />
          <q-btn flat round color="primary" icon="share" />
        </q-card-actions>
      </q-card-section>

      <q-separator />

      <q-card-section>
        <q-card-section>
          {{ institucion.informacion }}
        </q-card-section>
        <q-separator />
        <q-card-section class="col-5 custom-info-section">
          <p><strong>Dirección:</strong> {{ institucion.direccion }}</p>
          <p><strong>Teléfono:</strong> {{ institucion.telefono }}</p>
          <p><strong>Tipo:</strong> {{ institucion.tipo }}</p>
          <p><strong>Vacante:</strong> {{ institucion.vacante }}</p>
          <p><strong>Mensualidad:</strong> {{ institucion.mensualidad }}</p>
          <p><strong>Tipo:</strong> {{ institucion.tipo }}</p>
        </q-card-section>
      </q-card-section>
    </q-card>
  </div>

  <!--Paginación-->
  <div class="q-pa-lg flex flex-center">
    <q-pagination
      v-model="paginaActual"
      :max="totalPaginas"
      direction-links
      unelevated
      color="black"
      active-color="purple"
      @input="cambiarPagina"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      instituciones: [],
      //paginacion 2
      itemsPorPagina: 6, // Número de items por página
      paginaActual: 1,
    };
  },
  //paginacion 3
  computed: {
    totalPaginas() {
      return Math.ceil(this.instituciones.length / this.itemsPorPagina);
    },
    paginatedInstituciones() {
      const inicio = (this.paginaActual - 1) * this.itemsPorPagina;
      const fin = inicio + this.itemsPorPagina; // Mostrar 1x3 tarjetas en cada página
      return this.instituciones.slice(inicio, fin);
    },
  },
  mounted() {
    this.obtenerInstituciones();
  },
  methods: {
    async obtenerInstituciones() {
      try {
        const response = await fetch("http://127.0.0.1:8000/instituciones");
        const data = await response.json();

        console.log("Datos de instituciones obtenidos:", data);

        this.instituciones = data;
      } catch (error) {
        console.error("Error al obtener los instituciones:", error);
      }
    },
    //paginacion 4
    cambiarPagina(pagina) {
      this.paginaActual = pagina;
    },
  },
};
</script>

<style lang="scss">
.custom-info-section {
  line-height: 1; /* Puedes ajustar este valor según tus preferencias */
  margin-bottom: 0; /* Elimina el margen inferior */
  padding-bottom: 0; /* Elimina el espacio de relleno inferior */
}
</style>
