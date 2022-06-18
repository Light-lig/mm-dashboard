<template>
  <div class="table-responsive">
    <table class="table table-striped table-hover mt-3">
      <thead>
        <tr>
          <th v-for="(header, index) in headers" :key="index">{{ header }}</th>
        </tr>
      </thead>
      <tbody v-if="data">
        <tr v-if="data.length == 0">
          <td :colspan="headers.length" class="text-center">
            No se encontraron registros por mostrar.
          </td>
        </tr>
        <tr v-for="(value, index) in data" :key="value.cat_id">
          <td>{{ index + 1 }}</td>
          <td>{{ value.cat_tipo }}</td>
          <td>
            <a href="#" class="btn btn-warning" @click="edit(value.cat_id)"
              ><i class="fa fa-edit"></i> Editar</a
            >
            <a href="#" class="btn btn-danger" @click="deleteValue(value.cat_id)"
              ><i class="fa fa-trash"></i> Eliminar</a
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    headers: {
      type: Array,
      required: false,
      default: () => [],
    },
    data: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  mounted() {
    console.log("Table: ",this.data);
  },
  methods: {
    async deleteValue(cat_id) {
      this.$emit("delete", cat_id);
    },
    async edit(cat_id) {
      this.$emit("edit", cat_id);
    },
  },
};
</script>

<style>
</style>
