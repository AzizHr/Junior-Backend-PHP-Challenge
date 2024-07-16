import { createRouter, createWebHistory } from 'vue-router';
import Products from '../pages/Products.vue';
import AddProduct from '../pages/AddProduct.vue';

const routes = [
  {
    path: '/products',
    name: 'Products',
    component: Products
  },
  {
    path: '/add-product',
    name: 'AddProduct',
    component: AddProduct
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
