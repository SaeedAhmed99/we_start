import  {createRouter, createWebHistory} from 'vue-router';
import coursesInex from '../components/courses/index.vue';

const routes = [
    {
        path:'/',
        component:coursesInex
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
