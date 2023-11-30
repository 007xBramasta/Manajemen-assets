<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Manajemen Asset</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class="d-flex" v-if="isGuest">
                    <router-link to="/login" class="btn btn-primary me-2">Login</router-link>
                    <router-link to="/register" class="btn btn-primary">Register</router-link>
                </div>
                <div class="d-flex" v-else>
                    <button class="btn btn-primary me-2" @click="confirmLogout">Logout</button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "AppHeader",
    props: {
        isGuest: Boolean
    },
    methods: {
        confirmLogout() {
            Swal.fire({
                title: "Konfirmasi Logout",
                text: "Apakah Anda yakin ingin logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.logout();
                }
            });
        },
        logout() {
            axios.post('/api/logout', {}, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response => {
                Swal.fire("Sukses!", "Logout berhasil", "success");
                localStorage.removeItem('token');
                this.$router.push({ name: 'Login' });
            }).catch(error => {
                Swal.fire("Gagal!", "Terjadi kesalahan saat logout", "error");
                console.log(error);
            });
        }
    }
};
</script>
