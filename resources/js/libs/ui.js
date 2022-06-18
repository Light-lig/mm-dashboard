import Swal from "sweetalert2";

export default {
    alert: (titulo = "", icono = "success") => {
        const Toast = swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", swal.stopTimer);
                toast.addEventListener("mouseleave", swal.resumeTimer);
            },
        });
        Toast.fire({
            icon: icono,
            title: titulo,
        });
    },
};
