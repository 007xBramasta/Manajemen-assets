<template>
    <div>
        <AppHeader @update-navbar="updateNavbar" :isGuest="isGuest" />
        <router-view @update-navbar="updateNavbar" />
    </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue';

export default {
    name: 'App',
    components: {
        AppHeader
    },
    data() {
        return {
            isGuest: true
        };
    },
    methods: {
        updateNavbar() {
            const token = localStorage.getItem('token');

            if (token) {
                this.isGuest = false;
            } else {
                this.isGuest = true;
            }
        }
    },
    mounted() {
        const token = localStorage.getItem('token');
        if (token) {
            this.isGuest = false;
        } else {
            this.isGuest = true;
        }
    }
};
</script>
