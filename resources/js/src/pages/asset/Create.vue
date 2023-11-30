<template>
    <div class="container mt-5">
        <h1>Tambah Asset</h1>

        <form @submit.prevent="handleSubmit">
            <div class="mb-3">
                <label class="form-label">Nama Asset</label>
                <input type="text" class="form-control" v-model="asset.name">
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Asset</label>
                <input type="file" class="form-control" v-on:change="asset.image = $event.target.files[0]">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Asset</label>
                <textarea class="form-control" rows="3" cols="10" v-model="asset.description"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Asset</label>
                <input type="number" class="form-control" v-model="asset.quantity">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "CreateAsset",
    data() {
        return {
            asset: {
                name: '',
                image: '',
                description: '',
                quantity: 0
            }
        }
    },
    methods: {
        handleSubmit() {
            const formData = new FormData();

            formData.append('name', this.asset.name);
            formData.append('image', this.asset.image);
            formData.append('description', this.asset.description);
            formData.append('quantity', this.asset.quantity);

            axios.post('/api/assets', formData, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response => {
                Swal.fire("Sukses!", "Tambah asset berhasil", "success");
                this.$router.push({ name: 'Home' });
            }).catch(error => {
                Swal.fire("Gagal!", "Terjadi kesalahan saat menambah asset", "error");
                console.log(error);
            });
        }
    },
    mounted() {
        this.$emit('update-navbar');
    }
}
</script>
