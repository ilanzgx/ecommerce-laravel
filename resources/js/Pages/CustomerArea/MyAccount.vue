<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">
      
      <div class="flex md:justify-evenly bg-gray-700 px-2 py-4">
        <div class="md:w-1/6 w-1/3 flex justify-center">
          <svg class="w-16 h-16 cursor-pointer text-purple-500 bg-white rounded-full p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>

        <div class="md:w-4/6 w-1/3">
          <div>
           <h1 class="md:text-2xl text-lg font-semibold">
            <span v-if="data.genre == 'Masculino'">Bem vindo</span> <span v-else-if="data.genre == 'Feminino'">Bem vinda</span> <span v-else>Bem vindx</span>, {{ data.full_name }}
            </h1>
           <h2 class="flex md:items-center md:justify-start">
             <svg class="w-6 h-6 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
             <span>{{ data.email }}</span>
            </h2>
          </div>
        </div>

        <div class="md:w-1/6 w-1/3 flex items-center">
          <Link :href="$route('customer.mydata')">
            <svg class=" w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          </Link>
        </div>
      </div>
      
      <div class="flex items-center uppercase font-semibold my-5 text-justify">
        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        <p class="px-3 md:text-2xl text-lg">Seu último pedido</p>
      </div>

      <div class="bg-gray-700 px-2 py-4">
        <div class="md:flex">
          <div class="md:w-1/4">
            <h2 class="uppercase font-medium text-xl">Numero do pedido</h2>
            <p v-if="lastOrder != null">#{{ lastOrder.payment_id }}</p>
            <p v-else>NENHUM</p>
          </div>
          <div class="md:w-1/4"> 
            <h2 class="uppercase font-medium text-xl">Preço total</h2>
            <p v-if="lastOrder != null">R${{ lastOrder.total_order_price }}</p>
            <p v-else>NENHUM</p>
          </div>
          <div class="md:w-1/4">
            <h2 class="uppercase font-medium text-xl">Data</h2>
            <p v-if="lastOrder != null">{{ lastOrder.created_at | formatDate }}</p>
            <p v-else>NENHUM</p>
          </div>
          <div class="md:w-1/4">
            <h2 class="uppercase font-medium text-xl">Pagamento</h2>
            <p v-if="lastOrder != null">{{ lastOrder.payment_type }}</p>
            <p v-else>NENHUM</p>
          </div>
        </div>
      </div>

    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'

export default {
  components: {
    Header, Footer
  },
  props: {
    data: Object,
    lastOrder: Object,
  }
}
</script>