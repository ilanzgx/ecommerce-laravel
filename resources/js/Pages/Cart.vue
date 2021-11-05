<template>
  <div class="">
    <Header></Header>
    <div v-if="debug" class="container flex h-screen">
      <div class="m-auto">
        <p class="text-xl md:text-3xl lg:text-4xl text-purple-500 font-bold">Ops, seu carrinho está vazio :(</p>
        <p class="text-sm md:text-base lg:text-lg text-gray-300 text-center">
          <Link class="font-bold" :href="$route('index')">Clique aqui</Link> 
          para voltar a comprar. 
        </p>
      </div>
    </div>

    <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-12 mx-6 my-4">
      <!-- products -->
      <div class="">
        <div class="default-cart-box">
          <div class="w-1/3">
            <img class="w-32 h-32" src="/storage/camiseta.png">
          </div>
          <div class="w-1/3">
            <p>Camiseta</p>
            <p>R$50</p>
          </div>
          <div class="w-1/3">
            <button class="bg-red-500 px-3 py-2 rounded-3xl">Remover</button>
          </div>          
        </div>

        <div class="default-cart-box">
          <div class="w-1/3">
            <img class="w-32 h-32" src="/storage/camiseta.png">
          </div>
          <div class="w-1/3">
            <p>Camiseta</p>
            <p>R$50</p>
          </div>
          <div class="w-1/3">
            <button class="bg-red-500 px-3 py-2 rounded-3xl">Remover</button>
          </div>          
        </div>

        <div class="default-cart-box">
          <div class="w-1/3">
            <img class="w-32 h-32" src="/storage/camiseta.png">
          </div>
          <div class="w-1/3">
            <p>Camiseta</p>
            <p>R$50</p>
          </div>
          <div class="w-1/3">
            <button class="bg-red-500 hover:bg-red-600 px-3 py-2 rounded-3xl transition duration-200">Remover</button>
          </div>          
        </div>

      </div>

      <!-- total value -->
      <div class=" flex items-center justify-center">
        Valor
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../components/Header.vue'
import Footer from './../components/Footer.vue'
import Item from './../components/Cart/Item.vue'

export default {
  data(){
    return {
      debug: 0,  
    }
  },
  components:{
    Header, Footer, Item
  },
  props:{
    data: Object,
  },
}
</script>