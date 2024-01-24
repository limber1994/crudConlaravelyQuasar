<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="col-7">
          <div class="q-pa-md">
            <h6 class="text-center bg-dark border border-success text-white">
              Editar Test
            </h6>
            <q-form
              @submit.prevent="guardarCambios"
              @reset="resetForm"
              class="q-gutter-md"
            >
              <q-input
                filled
                v-model="test.fecha"
                label="Fecha *"
                hint="Fecha que se hizo el test"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <div>
                <q-btn
                  label="Guardar"
                  type="submit"
                  class="q-ml-sm custom-add-button"
                />
              </div>
            </q-form>
          </div>
        </q-card-section>
        <q-img
          class="col-5"
          src="https://previews.123rf.com/images/rawpixel/rawpixel1612/rawpixel161249228/67994301-aplicaci%C3%B3n-del-concepto-de-llenado-de-formulario-de-documento.jpg"
        />
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      test: {
        fecha: "",
      },
    };
  },
  mounted() {
    this.obtenerTest();
  },
  methods: {
    async obtenerTest() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(`http://127.0.0.1:8000/tests/${id}`);
        const data = await response.json();
        this.test = data;
      } catch (error) {
        console.error("Error al obtener el test:", error);
      }
    },
    async guardarCambios() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(
          `http://127.0.0.1:8000/tests/update/${id}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.test),
          }
        );

        if (response.ok) {
          console.log("Test actualizado correctamente");
          this.$router.push("/");
        } else {
          console.error("Error al actualizar el test");
        }
      } catch (error) {
        console.error("Error al guardar los cambios:", error);
      }
    },
    resetForm() {
      // Puedes añadir aquí la lógica de reinicio si lo necesitas
    },
  },
};
</script>

<style scoped>
.custom-add-button {
  background-color: #312d2d;
  color: white; /* Cambia el color del texto si es necesario */
}
.my-card {
  width: 100%;
  max-width: 1500px;
}
.custom-form-container {
  max-width: 1000px; /* Establece el ancho máximo en el contenedor */
}
</style>
