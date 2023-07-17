import { createRouter, createWebHistory } from 'vue-router';

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/detail/:id',
            component: () => import('../pages/Detail.vue'),
        },
        {
            path: '/',
            component: () => import('../pages/Home.vue')
        }
    ],
})
