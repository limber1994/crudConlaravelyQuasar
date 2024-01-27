<template>
  <div class="q-pa-md text-center">
    <q-btn
      @click="generarReporte"
      class="custom-add-button"
      icon="print"
      label="Generar Reporte"
    />
  </div>
</template>

<script>
export default {
  methods: {
    async generarReporte() {
      try {
        const response = await fetch("http://127.0.0.1:8000/usuarios/pdf");

        if (response.ok) {
          const blob = await response.blob();
          const url = window.URL.createObjectURL(blob);
          window.open(url, "_blank");
        } else {
          console.error("Error al generar el reporte");
        }
      } catch (error) {
        console.error("Error al intentar generar el reporte:", error);
      }
    },
  },
};
</script>

<style scoped>
.custom-add-button {
  background-color: #312d2d;
  color: white;
}
</style>
