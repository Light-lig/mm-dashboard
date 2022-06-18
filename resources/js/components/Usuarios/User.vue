<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <div class="row">
                    <h1>Usuario</h1>
                    <!-- Form -->
                    <div class="col-md-4 d-none">
                        <input
                            class="form-control"
                            type="text"
                            v-model="user.usr_id"
                        />
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Correo del usuario</label>
                        <input
                            id="txtCorreo"
                            class="form-control"
                            type="text"
                            v-model="user.usr_correo"
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.usr_correo"
                        >
                            {{ errors.usr_correo[0] }}
                        </div>
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Password del usuario</label>
                        <input
                            id="txtPassword"
                            class="form-control"
                            type="password"
                            v-model="user.usr_password"
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.usr_password"
                        >
                            {{ errors.usr_password[0] }}
                        </div>
                    </div>
                    <div class="col-md-4 pt-3">
                        <label>Tipo usuario</label>
                        <select
                            id="tipoUsuario"
                            v-model="user.usr_role"
                            class="form-select"
                        >
                            <option selected disabled>Seleccionar Role</option>
                            <option
                                v-for="role in roles"
                                :key="role.name"
                                :value="role.name"
                            >
                                {{ role.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-12 pt-3">
                        <a
                            id="btnSave"
                            class="btn btn-success d-none"
                            @click="save()"
                            v-if="textButton == 'Guardar'"
                        >
                            <i class="fa fa-save"></i> {{ textButton }}
                        </a>
                        <a
                            class="btn btn-warning"
                            @click="save()"
                            v-if="textButton == 'Editar'"
                            ><i class="fa-solid fa-pencil"></i>
                            {{ textButton }}</a
                        >
                    </div>

                    <!-- Table -->
                    <users-table
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

$(document).ready(function () {
    $("#tipoUsuario").change();
    //$("#tipoUsuario").prop("selectedIndex", 0);
    $("#txtCorreo").keyup(function () {
        $("#tipoUsuario").change();
    });
    $("#txtPassword").keyup(function () {
        $("#tipoUsuario").change();
    });
    $("#tipoUsuario").change(function () {
        let correo = $("#txtCorreo").val();
        let password = $("#txtPassword").val();
        let role = $("#tipoUsuario").val();
        if (correo.length > 0 && password.length > 0 && role != null)
            $("#btnSave").removeClass("d-none");
        else {
            $("#btnSave").addClass("d-none");
            ui.alert("Favor completar formulario.", "warning");
        }
    });
});
export default {
    props: ["iduser"],
    data: () => {
        return {
            user: {
                usr_id: "",
                usr_correo: "",
                usr_password: "",
            },
            roles: [],
            data: [],
            errors: {},
            headers: ["#", "Correo", "Creado", "Actualizado", "Acciones"],
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

            axios.get("api/users").then((res) => {
                //console.log(res.data.data);
                this.data = res.data.user.data;
                this.roles = res.data.role;
            });

            this.loading = false;
        },

        async save() {
            let res;
            switch (this.textButton) {
                case "Guardar":
                    //console.log("->", this.user);
                    this.user.usr_id_padre = this.iduser;
                    this.loading = true;
                    axios
                        .post("api/users", this.user)
                        .then((res) => {
                            ui.alert("Registro creado correctamente.");
                        })
                        .catch((e) => {
                            if (e.response.status == 422) {
                                this.errors = e.response.data.errors;
                                ui.alert(
                                    "Error al crear el registro.",
                                    "error"
                                );
                            }
                        });
                    this.loading = false;
                    $("#tipoUsuario").change(function () {
                        let correo = $("#txtCorreo").val();
                        let password = $("#txtPassword").val();
                        let role = $("#tipoUsuario").val();
                        if (
                            correo.length > 0 &&
                            password.length > 0 &&
                            role != null
                        )
                            $("#btnSave").removeClass("d-none");
                        else {
                            $("#btnSave").addClass("d-none");
                            ui.alert("Favor completar formulario.", "warning");
                        }
                    });
                    $("#tipoUsuario").change();
                    break;
                case "Editar":
                    this.loading = true;
                    this.user.usr_id_padre = this.iduser;
                    res = await axios
                        .put(`api/users/${this.user.usr_id}`, this.user)
                        .then((res) => {
                            ui.alert("Registro actualizado correctamente.");
                        })
                        .catch((e) => {
                            if (e.response.status == 422) {
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
            axios.get(`api/users/${id}`).then((res) => {
                this.user = res.data.data;
                this.textButton = "Editar";
            });
            this.loading = false;
        },

        async deleteP(id) {
            Swal.fire({
                title: "¿Estás seguro de eliminar este registro?",
                text: "xd",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Confimar",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await axios
                        .delete(`api/users/${id}`)
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
            this.user = {
                usr_correo: "",
            };
            this.textButton = "Guardar";
        },
    },
};
</script>

<style></style>
