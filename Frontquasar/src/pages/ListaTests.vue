<template>
  <div class="lista-tests">
    <div class="action-buttons q-pa-md q-gutter-sm text-center">
      <q-btn
        @click="agregarTest"
        class="custom-add-button"
        icon="add"
        label="Agregar Test"
      />

      <reporteador-test></reporteador-test>
    </div>

    <div class="search-input q-pa-md text-center">
      <q-input
        v-model="busqueda"
        outlined
        dense
        @input="filtrarTests"
        placeholder="Buscar test"
        class="custom-search-input"
      />
    </div>

    <div class="user-table q-pa-md">
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
        :filter="busqueda"
        ref="table"
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
import ReporteadorTest from "components/ReporteadorTest.vue";

export default {
  components: {
    ReporteadorTest,
  },
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
          name: "nombre",
          required: true,
          label: "Nombre",
          align: "left",
          field: "nombre",
          sortable: true,
        },
        {
          name: "uno",
          required: true,
          label: "Primer Área",
          align: "left",
          field: "uno",
          sortable: true,
        },
        {
          name: "dos",
          required: true,
          label: "Segunda Área",
          align: "left",
          field: "dos",
          sortable: true,
        },
        {
          name: "tres",
          required: true,
          label: "Tercer Área",
          align: "left",
          field: "tres",
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
      busqueda: "",
    };
  },
  mounted() {
    this.obtenerTests();
  },
  methods: {
    async obtenerTests() {
      try {
        const response = await fetch("http://143.198.50.189:8000/tests");
        const data = await response.json();

        console.log("Datos de tests obtenidos:", data);

        this.tests = data;
      } catch (error) {
        console.error("Error al obtener los tests:", error);
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
      }
    },
    async crearReporteador() {
      try {
        const response = await fetch("http://143.198.50.189:8000/tests/pdf");

        if (response.ok) {
          // Manejar la respuesta exitosa, por ejemplo, abrir el PDF en una nueva pestaña
          const blob = await response.blob();
          const url = window.URL.createObjectURL(blob);
          window.open(url, "_blank");
        } else {
          console.error("Error al generar el reporte de tests");
          // Manejar el error, mostrar mensaje al test, etc.
        }
      } catch (error) {
        console.error("Error al intentar generar el reporte:", error);
        // Manejar el error, mostrar mensaje al test, etc.
      }
    },
    async confirmarEliminarTest(id) {
      try {
        const confirmacion = confirm("¿Estás seguro de eliminar este test?");
        if (confirmacion) {
          const response = await fetch(
            `http://143.198.50.189:8000/tests/eliminar/${id}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            await this.obtenerTests();
          } else {
            console.error("Error al intentar eliminar el test");
          }
        }
      } catch (error) {
        console.error("Error al confirmar la eliminación:", error);
      }
    },
    filtrarTests() {
      this.$refs.table.filter(this.busqueda);
    },
  },
};
</script>

<style lang="scss">
.my-sticky-virtscroll-table {
  height: 410px;
}
.custom-add-button {
  background-color: #312d2d;
  color: white;
}

.custom-search-input {
  width: 200px; /* Ajusta el ancho según tus necesidades */
  margin-top: 5px;
}

.text-center {
  text-align: center;
}
.lista-tests {
  max-width: 1200px;
  margin: 0 auto;
}

.action-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
}

.search-input {
  margin-top: -40px;
}

.user-table {
  margin-top: 10px;
}

.lista-tests {
  max-width: 1400px;
  margin: 0 auto;
}

.action-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px; /* Reducido el espacio entre botones */
}

.search-input {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 10px; /* Ajusta según sea necesario */
}

.custom-search-input {
  width: 300px; /* Ancho del buscador según tus necesidades */
  border-radius: 20px; /* Bordes redondeados */
}

.custom-search-input input {
  padding: 10px; /* Espaciado interno del input */
  font-size: 14px; /* Tamaño de fuente */
  border-radius: 20px; /* Bordes redondeados */
}
</style>
