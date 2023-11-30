<template>
    <div class="container mt-5">
        <h3 class="mb-3">Login Form</h3>
        <form @submit.prevent="login">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" v-model="user.email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" v-model="user.password">
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "Login",
    data() {
        return {
            user: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        // fungsi untuk login user
        login() {
            axios.post('/api/login', this.user)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login berhasil',
                        text: 'Selamat datang!',
                    });
                    localStorage.setItem('token', response.data.access_token);

                    // router push berfungsi untuk mengarahkan user ke halaman lain setelah login berhasil
                    this.$router.push({ name: 'Home' });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login gagal',
                        text: error.response.data.message,
                    });
                });
        }
    },
    mounted() {
        // emit berfungsi untuk mengirimkan event ke parent component (App.vue)
        this.$emit('update-navbar');
    }
};
</script>
