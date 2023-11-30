<template>
    <div class="container mt-5">
        <h3 class="mb-3">Register Form</h3>
        <form @submit.prevent="register">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" v-model="user.name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" v-model="user.email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" v-model="user.password">
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "Register",
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    methods: {
        // fungsi untuk register user
        register() {
            axios.post('/api/register', this.user)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Register berhasil',
                        text: 'Selamat datang!',
                    });
                    localStorage.setItem('token', response.data.access_token);
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Register gagal',
                        text: error.response.data.message,
                    });
                });
        }
    }
}
</script>
