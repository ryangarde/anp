import VueRouter from 'vue-router';
import Home from './components/Home';
import Shop from './components/Shop';

let routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/shop',
        component: Shop
    }
];

export default new VueRouter({
    routes
});