<template>
  <div class="">
    <div class="md:flex">
      <!-- lateral bar -->
      <div class="w-full md:w-1/5 bg-gray-700 md:h-screen">
        <div class="flex justify-center items-center border-b border-gray-600 py-4 px-2">
          <Link class="flex items-center" :href="$route('index')">
            <img width="80" height="80" src="/storage/logo1.png" alt="">
            <p class="text-xs font-medium">Loja virtual sem nome</p>
          </Link>
        </div>

        <div class="">
          <div @click="changePage(0)" :class="{'bg-gray-900': page == 0}" class="hover:bg-gray-600 cursor-pointer text-center">
            <button class="flex py-3 mx-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
              <p class="px-3">Dashboard</p>
            </button>
          </div>
          
          <div @click="changePage(1)" :class="{'bg-gray-900': page == 1}" class="hover:bg-gray-600 cursor-pointer">
            <button class="flex py-3 mx-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
              <p class="px-3">Pedidos</p>
            </button>
          </div>

          <div @click="changePage(2)" :class="{'bg-gray-900': page == 2}" class="hover:bg-gray-600 cursor-pointer">
            <button class="flex py-3 mx-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
              <p class="px-3">Pedidos aprovados</p>
            </button>
          </div>

          <div @click="changePage(3)" :class="{'bg-gray-900': page == 3}" class="hover:bg-gray-600 cursor-pointer ">
            <button class="flex py-3 mx-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              <p class="px-3">Produtos</p>
            </button>
          </div>

          <div @click="changePage(4)" :class="{'bg-gray-900': page == 4}" class="hover:bg-gray-600 cursor-pointer ">
            <button class="flex py-3 mx-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              <p class="px-3">Usuários</p>
            </button>
          </div>

          <div @click="changePage(5)" :class="{'bg-gray-900': page == 5}" class="hover:bg-gray-600 cursor-pointer ">
            <button class="flex py-3 mx-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
              <p class="px-3">Categorias</p>
            </button>
          </div>

          <div @click="changePage(6)" :class="{'bg-gray-900': page == 6}" class="hover:bg-gray-600 cursor-pointer ">
            <button class="flex py-3 mx-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              <p class="px-3">Consultar pedido</p>
            </button>
          </div>
          
        </div>
      </div>
      
      <div class="w-full md:w-4/5 p-2">
        <Dashboard 
          v-if="page == 0" 
          :data="dashboard"></Dashboard>

        <Orders 
          v-else-if="page == 1" 
          :data="orders"></Orders>

        <OrdersAccepted 
          v-else-if="page == 2" 
          :data="orders_accepted"></OrdersAccepted>

        <Products 
          v-else-if="page == 3" :data="products" 
          :categories="categories"></Products>

        <Users 
          v-else-if="page == 4" 
          :data="users"></Users>

        <Categories 
          v-else-if="page == 5" 
          :data="categories"></Categories>

        <OrderData 
          v-else-if="page == 6" 
          :data="categories"></OrderData>

      </div>
    </div>
  </div>
</template>

<script>
import Dashboard from '../../components/Admin/Dashboard.vue'
import Categories from '../../components/Admin/Categories.vue'
import Orders from '../../components/Admin/Orders.vue'
import OrdersAccepted from '../../components/Admin/OrdersAccepted.vue'
import Products from '../../components/Admin/Products.vue'
import Users from '../../components/Admin/Users.vue'
import OrderData from '../../components/Admin/OrderData.vue'

export default {
  data(){
    return {
      /* page numbers
      ** dashboard -       0
      ** orders -          1
      ** orders accepted - 2
      ** products -        3
      ** users -           4
      ** categories -      5
      */
      page: 0,
    }
  },
  methods: {
    changePage(page){
      this.page = page
    }
  },
  props: {
    dashboard: Object,
    products: Array,
    orders: Array,
    orders_accepted: Array,
    users: Array,
    categories: Array,
  },
  components: {
    Dashboard, Orders, Products, Users, Categories, OrdersAccepted, OrderData
  }
}
</script>