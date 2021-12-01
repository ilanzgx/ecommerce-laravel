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

    <div v-else class="">
      <!-- products -->

        <div v-for="data in products" :key="data.id">
          <CartItem 
            :id="data.id"
            :name="data.name" 
            :image="data.image"
            :description="data.description" 
            :price="data.price" 
            :original_price="data.original_price"
            :stock="data.stock" 
            :amount="data.amount">
          </CartItem>
        </div>
        

      <!-- total value -->
      <div class="flex items-center justify-center">
        Total: R${{ total_value }}
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
    products: Array,
    empty: Boolean,
    total_value: Number,
  },
}
</script>