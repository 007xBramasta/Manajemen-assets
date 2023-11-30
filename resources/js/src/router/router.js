import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "Home",
        component: () => import("../pages/Home.vue")
    },
    {
        path: "/asset/create",
        name: "CreateAsset",
        component: () => import("../pages/asset/Create.vue")
    },
    {
        path: "/asset/edit/:id",
        name: "EditAsset",
        component: () => import("../pages/asset/Edit.vue")
    },
    {
        path: "/login",
        name: "Login",
        component: () => import("../pages/Login.vue")
    },
    {
        path: "/register",
        name: "Register",
        component: () => import("../pages/Register.vue")
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
