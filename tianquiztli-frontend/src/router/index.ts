import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import Principal from '../views/Principal.vue'
import Register from '../views/Register.vue'
import Login from '../views/Login.vue'
import Cart from '../views/Cart.vue'
import Compras from '../views/Compras.vue'
import Products from '../views/Products.vue'
import ProductsDetail from '../views/ProductsDetail.vue'
import Payment from '../views/Payment.vue'
import Categorias from '../views/Categorias.vue'
import Home from '../views/admin/Home.vue'
import Usuarios from '../views/EditUser.vue'


Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Principal',
    component: Principal
  },
  {
    path: '/Login',
    name: 'Login',
    component: Login
  },
  {
    path: '/Register',
    name: 'Register',
    component: Register
  },
  {
    path: '/carrito',
    name: 'Carrito',
    component: Cart
  },
  {

    path: '/compras',
    name: 'Compras',
    component: Compras
  },
  {

    path: '/productos',
    name: 'Products',
    component: Products
  },
  {
    path: '/productos/:productID',
    name: 'ProductsDetail',
    component: ProductsDetail
  },
  {
    path: '/pago',
    name: 'Payment',
    component: Payment
  },
  {
    path: '/categories',
    name: 'Categorias',
    component: Categorias
  },
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/Usuarios',
    name: 'Usuarios',
    component: Usuarios
  },

]

const router = new VueRouter({
  routes
})

export default router
