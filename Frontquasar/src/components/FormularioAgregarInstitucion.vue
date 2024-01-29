<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="col-7">
          <div class="q-pa-md">
            <h6 class="text-center bg-dark border border-success text-white">
              Agregar Institucion
            </h6>
            <q-form
              @submit.prevent="agregarNuevoInstitucion"
              @reset="resetForm"
              class="q-gutter-md"
            >
              <q-input
                filled
                v-model="nuevoInstitucion.nombre"
                label="Nombre *"
                hint="Nombre y apellido"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />
              <q-input
                filled
                v-model="nuevoInstitucion.direccion"
                label="Direccion *"
                hint="Direccion"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />
              <q-input
                filled
                type="number"
                v-model="nuevoInstitucion.telefono"
                label="Telefono *"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') ||
                    'Por favor, ingresa tu edad',
                  (val) =>
                    (val > 0 && val < 10000000000) ||
                    'Por favor, ingresa una edad real',
                ]"
              />
              <q-input
                filled
                v-model="nuevoInstitucion.tipo"
                label="Tipo *"
                hint="Privado o Publico"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />
              <q-input
                filled
                v-model="nuevoInstitucion.turno"
                label="Turno *"
                hint="Manaña o tarde"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />
              <q-input
                filled
                type="number"
                v-model="nuevoInstitucion.vacante"
                label="Vacante*"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') ||
                    'Por favor, ingresa tu edad',
                  (val) =>
                    (val > 0 && val < 10000000000) ||
                    'Por favor, ingresa una edad real',
                ]"
              />
              <q-input
                filled
                v-model="nuevoInstitucion.informacion"
                label="Informacion *"
                hint="Informacion de la institucion"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />
              <!-- ... Otras partes del formulario ... -->

              <q-input
                filled
                v-model="nuevoInstitucion.foto"
                label="Foto *"
                hint="Foto de la institucion"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Por favor, ingresa algo',
                ]"
              />

              <!-- Agregar un bloque div para mostrar la imagen -->
              <div class="q-mt-md">
                <q-img
                  v-if="
                    nuevoInstitucion.foto && nuevoInstitucion.foto.length > 0
                  "
                  :src="nuevoInstitucion.foto"
                  :alt="nuevoInstitucion.nombre"
                />
                <q-banner v-else icon="image" class="q-ma-md" color="warning">
                  No hay URL de imagen proporcionada.
                </q-banner>
              </div>

              <!-- ... Otras partes del formulario ... -->

              <q-input
                filled
                type="number"
                v-model="nuevoInstitucion.mensualidad"
                label="Mensualidad *"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') ||
                    'Por favor, ingresa tu edad',
                  (val) =>
                    (val > 0 && val < 10000000000) ||
                    'Por favor, ingresa una edad real',
                ]"
              />
              <q-input
                filled
                v-model="nuevoInstitucion.tipo_ins"
                label="Tipo *"
                hint="Universidad o Instituto"
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
                <q-btn
                  label="Cancelar"
                  type="reset"
                  flat
                  class="q-ml-sm custom-add-button"
                  @click="cancelarAgregar"
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
      nuevoInstitucion: {
        nombre: null,
        direccion: null,
        telefono: null,
        tipo: null,
        turno: null,
        vacante: null,
        informacion: null,
        foto: null,
        mensualidad: null,
        tipo_ins: null,
      },
    };
  },
  methods: {
    async agregarNuevoInstitucion() {
      // Lógica para enviar datos al backend (adaptar según tu backend en Laravel)
      console.log("Datos a enviar:", this.nuevoInstitucion);
      try {
        const response = await fetch(
          "http://127.0.0.1:8000/instituciones/nuevo",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.nuevoInstitucion),
          }
        );

        if (response.ok) {
          console.log("Institucion agregado exitosamente");
          this.$router.push("/instituciones");
        } else {
          const errorData = await response.json();
          throw new Error(
            errorData.message || "Error al agregar el Institucion"
          );
        }
      } catch (error) {
        console.error("Error al agregar el institucion:", error.message);
      }
    },
    cancelarAgregar() {
      this.$router.push("/instituciones");
    },
    resetForm() {
      this.nuevoInstitucion = {
        nombre: null,
        direccion: null,
        telefono: null,
        tipo: null,
        turno: null,
        vacante: null,
        informacion: null,
        foto: null,
        mensualidad: null,
        tipo_ins: null,
      };
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
