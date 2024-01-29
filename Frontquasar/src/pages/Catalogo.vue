<!-- eslint-disable-next-line vue/multi-word-component-names -->
<template>
  <br /><br />
  <div class="search-container">
    <!-- Ajusta los estilos según tus necesidades -->
    <q-input
      v-model="filtro"
      label="Buscar"
      outlined
      dense
      @input="aplicarFiltro"
      class="search-input"
    />
  </div>
  <div class="q-pa-md row justify-center items-start q-gutter-md">
    <q-card
      v-for="institucion in paginatedInstituciones"
      :key="institucion.id"
      class="my-card col-3"
      flat
      bordered
    >
      <q-card-section horizontal>
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
      itemsPorPagina: 6,
      paginaActual: 1,
      filtro: "",
    };
  },
  computed: {
    totalPaginas() {
      return Math.ceil(this.instituciones.length / this.itemsPorPagina);
    },
    paginatedInstituciones() {
      const inicio = (this.paginaActual - 1) * this.itemsPorPagina;
      const fin = inicio + this.itemsPorPagina;
      const institucionesFiltradas = this.instituciones.filter((inst) =>
        inst.nombre.toLowerCase().includes(this.filtro.toLowerCase())
      );

      return institucionesFiltradas.slice(inicio, fin);
    },
  },
  mounted() {
    this.obtenerInstituciones();
  },
  methods: {
    async obtenerInstituciones() {
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/instituciones?search=${this.filtro}`
        );
        const data = await response.json();
        this.instituciones = data;
      } catch (error) {
        console.error("Error al obtener las instituciones:", error);
      }
    },
    cambiarPagina(pagina) {
      this.paginaActual = pagina;
    },
    aplicarFiltro() {
      this.paginaActual = 1;
      this.obtenerInstituciones();
    },
  },
};
</script>

<style lang="scss">
.custom-info-section {
  line-height: 1;
  margin-bottom: 0;
  padding-bottom: 0;
}
.search-container {
  text-align: center;
  margin-bottom: 20px; /* Ajusta la separación entre el buscador y el contenido principal */
  margin-left: 600px;
}

.search-input {
  width: 300px; /* Ajusta el ancho del buscador según tus preferencias */
  font-size: 16px; /* Ajusta el tamaño de la fuente del buscador según tus preferencias */
}
</style>
