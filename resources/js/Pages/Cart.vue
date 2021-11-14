<template>
  <div class="">
    <Header></Header>
    <div v-if="empty" class="container flex h-screen">
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

        <CartItem ></CartItem>

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
import CartItem from './../components/Cart/Item.vue'

export default {
  data(){
    return {
       
    }
  },
  components:{
    Header, Footer, CartItem
  },
  props:{
    data: Array,
    empty: Boolean
  },
}
</script>