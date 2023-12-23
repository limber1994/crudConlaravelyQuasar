<template>
  <div>
    <div class="q-pa-md q-gutter-sm text-center">
      <q-btn
        @click="agregarAlumno"
        class="custom-add-button"
        icon="add"
        label="Agregar Alumno"
      />
    </div>
    <div class="q-pa-md">
      <q-table
        class="my-sticky-virtscroll-table"
        virtual-scroll
        flat
        bordered
        v-model:pagination="pagination"
        :rows-per-page-options="[0]"
        :virtual-scroll-sticky-size-start="48"
        row-key="id"
        :rows="alumnos"
        :columns="columns"
        dark
        color="amber"
      >
        <template v-slot:body-cell-acciones="props">
          <div class="q-pa-md q-gutter-sm text-center">
            <q-btn
              @click="editarAlumno(props.row.id)"
              square
              color="amber"
              icon="edit"
              class="q-ml-sm q-mr-sm"
            />
            <q-btn
              @click="confirmarEliminarAlumno(props.row.id)"
              square
              color="negative"
              icon="delete"
              class="q-ml-sm q-mr-sm"
            />
          </div>
        </template>
      </q-table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      alumnos: [],
      columns: [
        {
          name: "id",
          required: true,
          label: "ID",
          align: "left",
          field: "id",
          sortable: true,
        },
        {
          name: "nombre",
          required: true,
          label: "Nombre",
          align: "left",
          field: "nombre",
          sortable: true,
        },
        {
          name: "correo",
          required: true,
          label: "Correo",
          align: "left",
          field: "correo",
          sortable: true,
        },
        {
          name: "edad",
          required: true,
          label: "Edad",
          align: "left",
          field: "edad",
          sortable: true,
        },
        {
          name: "acciones",
          label: "Acciones",
          align: "center",
          field: "acciones",
          sortable: false,
        },
      ],
      pagination: {
        rowsPerPage: 0,
      },
    };
  },
  mounted() {
    this.obtenerAlumnos();
  },
  mounted() {
    this.obtenerAlumnos(); // Llama a la función para obtener los alumnos al cargar la página
  },
  methods: {
    async obtenerAlumnos() {
      try {
        const response = await fetch("http://127.0.0.1:8000/alumnos");
        const data = await response.json();

        console.log("Datos de alumnos obtenidos:", data); // Verifica los datos obtenidos en la consola

        this.alumnos = data; // Asigna los datos a la variable 'alumnos'
      } catch (error) {
        console.error("Error al obtener los alumnos:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async agregarAlumno() {
      this.$router.push({ name: "AgregarAlumno" });
    },
    async editarAlumno(id) {
      try {
        this.$router.push({ name: "editarAlumno", params: { id: id } });
      } catch (error) {
        console.error("Error al editar el alumno:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async confirmarEliminarAlumno(id) {
      try {
        const confirmacion = confirm("¿Estás seguro de eliminar este alumno?");
        if (confirmacion) {
          const response = await fetch(
            `http://127.0.0.1:8000/alumnos/eliminar/${id}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            // Eliminación exitosa
            // Puedes actualizar la lista de alumnos después de eliminar
            await this.obtenerAlumnos();
            // O realizar cualquier otra acción necesaria después de la eliminación
          } else {
            // Manejar el error si la eliminación falla
            console.error("Error al intentar eliminar el alumno");
            // Mostrar un mensaje al usuario, ejecutar acciones necesarias, etc.
          }
        }
      } catch (error) {
        console.error("Error al confirmar la eliminación:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
  },
};
</script>
<style lang="scss">
.my-sticky-virtscroll-table {
  height: 410px; /* Ajusta la altura según tus necesidades */
}
.custom-add-button {
  background-color: #312d2d;
  color: white; /* Cambia el color del texto si es necesario */
}
.text-center {
  text-align: center;
}
</style>
