<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="col-7">
          <div class="q-pa-md">
            <h6 class="text-center bg-dark border border-success text-white">
              Editar Alumno
            </h6>
            <q-form
              @submit.prevent="guardarCambios"
              @reset="resetForm"
              class="q-gutter-md"
            >
              <q-input
                filled
                v-model="alumno.nombre"
                label="Nombre *"
                hint="Nombre y apellido"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <q-input
                filled
                type="text"
                v-model="alumno.correo"
                label="Correo electrónico *"
                hint="example@example.com"
                lazy-rules
                :rules="[
                  (val) =>
                    /.+@.+\..+/.test(val) ||
                    'Por favor, ingresa un correo válido',
                ]"
              />

              <q-input
                filled
                type="number"
                v-model="alumno.edad"
                label="Edad *"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') ||
                    'Por favor, ingresa tu edad',
                  (val) =>
                    (val > 0 && val < 100) ||
                    'Por favor, ingresa una edad real',
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
      alumno: {
        nombre: "",
        correo: "",
        edad: null,
      },
    };
  },
  mounted() {
    this.obtenerAlumno();
  },
  methods: {
    async obtenerAlumno() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(`http://127.0.0.1:8000/alumnos/${id}`);
        const data = await response.json();
        this.alumno = data;
      } catch (error) {
        console.error("Error al obtener el alumno:", error);
      }
    },
    async guardarCambios() {
      try {
        const id = this.$route.params.id;
        const response = await fetch(
          `http://127.0.0.1:8000/alumnos/update/${id}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.alumno),
          }
        );

        if (response.ok) {
          console.log("Alumno actualizado correctamente");
          this.$router.push("/");
        } else {
          console.error("Error al actualizar el alumno");
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
