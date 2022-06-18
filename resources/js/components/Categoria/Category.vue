<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <div class="row">
                    <h1>Categoría</h1>
                    <!-- Form -->
                    <div class="col-md-4 d-none">
                        <input
                            class="form-control"
                            type="text"
                            v-model="category.cat_id"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Nombre del tipo de categoría</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="category.cat_tipo"
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.cat_tipo"
                        >
                            {{ errors.tipo[0] }}
                        </div>
                    </div>
                    <div class="col-md-12 pt-3">
                        <a 
                        class="btn btn-success" 
                        @click="save()"
                        v-if="textButton == 'Guardar'"
                        >
                            <i class="fa fa-save"></i> {{ textButton }}
                        </a>
                        <a
                            class="btn btn-warning"
                            @click="save()"
                            v-if="textButton == 'Editar'"
                            ><i class="fa fa-edit"></i> {{ textButton }}</a
                        >
                    </div>

                    <!-- Table -->
                    <category-table
                        :data="data"
                        :headers="headers"
                        @delete="deleteP($event)"
                        @edit="edit($event)"
                    />
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import ui from "../../libs/ui";
import Swal from "sweetalert2";

export default {
    data: () => {
        return {
            category: {
                cat_id: "",
                cat_tipo: "",
            },
            data: [],
            errors: {},
            headers: ["#", "Nombre", "Acciones"],
            textButton: "Guardar",
            loading: false,
            form_submitting: false,
        };
    },

    mounted() {
        this.initialize();
    },

    methods: {
        async initialize() {
            this.loading = true;

            axios.get("api/categorias").then((res) => {
                console.log(res.data.data);
                this.data = res.data.data;
            });

            this.loading = false;
        },

        async save() {
            let res;
            switch (this.textButton) {
                case "Guardar":
                    console.log("->", this.category);
                    this.loading = true;
                    axios
                        .post("api/categorias", this.category)
                        .then((res) => {
                            ui.alert("Registro creado correctamente.");
                        })
                        .catch((e) => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                                ui.alert(
                                    "Error al crear el registro.",
                                    "error"
                                );
                            }
                        });
                    this.loading = false;
                    break;
                case "Editar":
                    this.loading = true;
                    res = await axios
                        .put(
                            `api/categorias/${this.category.cat_id}`,
                            this.category
                        )
                        .then((res) => {
                            ui.alert("Registro actualizado correctamente.");
                        })
                        .catch((e) => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                                ui.alert(
                                    "Error al actualizar el registro.",
                                    "error"
                                );
                            }
                        });
                    this.loading = false;
                    break;
            }
            this.initialize();
            this.cleanInputs();
        },

        edit(id) {
            this.loading = true;
            axios.get(`api/categorias/${id}`).then((res) => {
                this.category = res.data.data;
                this.textButton = "Editar";
            });
            this.loading = false;
        },

        async deleteP(id) {
            Swal.fire({
                title: "¿Estás seguro de eliminar este registro?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Confimar",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await axios
                        .delete(`api/categorias/${id}`)
                        .then((res) => {
                            ui.alert("Registro eliminado correctamente.");                            
                        })
                        .catch((e) => {
                            ui.alert(
                                "Registro no pudo ser eliminado correctamente.",
                                "error"
                            );
                        });  
                    this.initialize();
                    this.cleanInputs();                  
                }
            });
        },

        cleanInputs() {
            this.category = {
                tipo: "",
            };
            this.textButton = "Guardar";
        },
    },
};
</script>

<style></style>
