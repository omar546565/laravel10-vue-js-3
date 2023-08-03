import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/register',
            name: 'Register',
            component: () => import('../pages/Register.vue')
        },
        {
            path: '/admin',
            name: 'Admin',
            component: () => import('../pages/Admin.vue')
        }
    ]
})
export default router
