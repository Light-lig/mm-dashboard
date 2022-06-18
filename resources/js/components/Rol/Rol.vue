<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <div class="row">
                    <h1>Control de Roles</h1>
                    <!-- Form -->
                    <div class="col-md-4 d-none">
                        <input
                            class="form-control"
                            type="text"
                            v-model="rol.id"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Nombre del Rol</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="rol.name"
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.name"
                        >
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="col-md-4 pt-3" v-if="rol.created_at != ''">
                        <label>Creado el</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="rol.created_at"
                            readonly
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.created_at"
                        >
                            {{ errors.created_at[0] }}
                        </div>
                    </div>
                    <div class="col-md-4 pt-3" v-if="rol.updated_at != ''">
                        <label>Actualizado el</label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="rol.updated_at"
                            readonly
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.updated_at"
                        >
                            {{ errors.updated_at[0] }}
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <h3>Permisos</h3>
                    <div class="col border p-2">

                        <div class="form-check form-switch form-check-inline" v-for="(p) in permisos" :key="p.id">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                :id="p.id"
                                name="permissions"
                                v-model="rol.selectPermissions"
                                :value="p.id"
                                :checked="permisos.includes(rol.permissions.id)"                                                                         
                            />
                            <label
                                class="form-check-label badge bg-danger fs-6"
                                :for="p.id"
                            >
                            {{ p.name }}
                            </label
                            >
                        </div>
                        
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
                <rol-table
                    :data="data"
                    :headers="headers"
                    @delete="deleteP($event)"
                    @edit="edit($event)"
                />
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
            rol: {
                id: "",
                name: "",
                created_at: "",
                updated_at: "",
                permissions: [],
                selectPermissions: [],
            },
            permisos: [],
            data: [],
            errors: {},
            headers: [
                "#",
                "Nombre",
                "Creado",
                "Actualizado",
                "Permisos",
                "Acciones",
            ],
            textButton: "Guardar",
            loading: false,            
        };
    },

    mounted() {
        this.initialize();
    },

    methods: {
        async initialize() {
            this.loading = true;

            axios.get("api/roles").then((res) => {
                this.data = res.data.data;
            });

            axios.get("api/permisos").then((res) => {
                this.permisos = res.data.data;
            });

            this.loading = false;
        },

        async save() {
            let res;
            switch (this.textButton) {
                case "Guardar":                    
                    /* console.log(".:: ", this.rol);
                    console.log("-> ", this.rol.selectPermissions[1]); */

                    this.loading = true;
                    /* await axios
                        .post("api/roles", this.rol)
                        .then((res) => {
                            console.log("S ->", res);
                            ui.alert("Registro creado correctamente.");
                        })
                        .catch((e) => {
                            console.log("F ->", e);
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                                ui.alert(
                                    "Error al crear el registro.",
                                    "error"
                                );
                            }
                        }); */
                    this.loading = false;
                    /* this.initialize();
            this.cleanInputs(); */
                    break;
                case "Editar":
                    this.loading = true;
                    res = await axios
                        .put(`api/roles/${this.rol.id}`, this.rol)
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
                    this.initialize();
            this.cleanInputs();
                    break;
            }            
        },

        edit(id) {
            this.loading = true;
            axios.get(`api/roles/${id}`).then((res) => {
                this.rol = res.data.data;
                /* this.rol.created_at = moment(
                    String(this.rol.created_at)
                ).format("MM/DD/YYYY hh:mm"); */
                console.log(".:: ", this.rol);
                console.log("-> ", this.rol.permissions.id);
                
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
                        .delete(`api/roles/${id}`)
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
            this.rol = {
                id: "",
                name: "",
                created_at: "",
                updated_at: "",
                permissions: [],
                selectPermissions: [],
            };
            this.textButton = "Guardar";
        },
    },
};
</script>

<style></style>
