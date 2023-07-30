import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/home',
            name: 'home',
            component: () => import('../pages/Home.vue')
        },
        {
            path: '/admin',
            name: 'Admin',
            component: () => import('../pages/Admin.vue')
        }
    ]
})
export default router
