<template>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th v-for="(header, index) in headers" :key="index">
                        {{ header }}
                    </th>
                </tr>
            </thead>
            <tbody v-if="data">
                <tr v-if="data.length == 0">
                    <td :colspan="headers.length" class="text-center">
                        No se encontraron registros por mostrar.
                    </td>
                </tr>
                <tr v-for="(value, index) in data" :key="value.usr_id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ value.usr_correo }}</td>
                    <td>{{ value.created_at }}</td>
                    <td>{{ value.updated_at }}</td>
                    <td>
                        <a
                            title="Editar"
                            class="btn btn-warning"
                            @click="edit(value.usr_id)"
                            ><i class="fa-solid fa-pencil"></i
                        ></a>
                        <a
                            title="Eliminar"
                            class="btn btn-danger"
                            @click="deleteValue(value.usr_id)"
                            ><i class="fa fa-trash"></i
                        ></a>
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
        console.log("Table: ", this.data);
    },
    methods: {
        async deleteValue(usr_id) {
            this.$emit("delete", usr_id);
        },
        async edit(usr_id) {
            this.$emit("edit", usr_id);
        },
    },
};
</script>

<style></style>
