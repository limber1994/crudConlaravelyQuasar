<template>
  <div>
    <div class="q-pa-md q-gutter-sm text-center">
      <q-btn
        @click="agregarTest"
        class="custom-add-button"
        icon="add"
        label="Agregar Test"
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
        :rows="tests"
        :columns="columns"
        dark
        color="amber"
      >
        <template v-slot:body-cell-acciones="props">
          <div class="q-pa-md q-gutter-sm text-center">
            <q-btn
              @click="editarTest(props.row.id)"
              square
              color="amber"
              icon="edit"
              class="q-ml-sm q-mr-sm"
            />
            <q-btn
              @click="confirmarEliminarTest(props.row.id)"
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
      tests: [],
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
          name: "idUsuario",
          required: true,
          label: "ID_USUARIO",
          align: "left",
          field: "id",
          sortable: true,
        },
        {
          name: "fecha",
          required: true,
          label: "Fecha",
          align: "left",
          field: "fecha",
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
    this.obtenerTests();
  },
  mounted() {
    this.obtenerTests(); // Llama a la función para obtener los tests al cargar la página
  },
  methods: {
    async obtenerTests() {
      try {
        const response = await fetch("http://127.0.0.1:8000/tests");
        const data = await response.json();

        console.log("Datos de tests obtenidos:", data); // Verifica los datos obtenidos en la consola

        this.tests = data; // Asigna los datos a la variable 'tests'
      } catch (error) {
        console.error("Error al obtener los tests:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async agregarTest() {
      this.$router.push({ name: "AgregarTest" });
    },
    async editarTest(id) {
      try {
        this.$router.push({ name: "editarTest", params: { id: id } });
      } catch (error) {
        console.error("Error al editar el test:", error);
        // Manejar el error, mostrar mensaje al usuario, etc.
      }
    },
    async confirmarEliminarTest(id) {
      try {
        const confirmacion = confirm("¿Estás seguro de eliminar este test?");
        if (confirmacion) {
          const response = await fetch(
            `http://127.0.0.1:8000/tests/eliminar/${id}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            // Eliminación exitosa
            // Puedes actualizar la lista de tests después de eliminar
            await this.obtenerTests();
            // O realizar cualquier otra acción necesaria después de la eliminación
          } else {
            // Manejar el error si la eliminación falla
            console.error("Error al intentar eliminar el test");
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
