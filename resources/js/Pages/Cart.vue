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

    <div v-else class="mx-2 my-4">
      <!-- products -->

        <div class="mb-6">
          <div class="flex items-center">
            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path></svg>
            <h1 class="text-2xl uppercase font-medium px-4">Produtos</h1>
          </div>
        </div>

        <div v-for="data in products" :key="data.id">
          <CartItem @updateTotal="updateTotalValue"
            :id="data.id"
            :name="data.name" 
            :image="data.image"
            :description="data.description" 
            :price="data.price" 
            :original_price="data.original_price"
            :stock="data.stock" 
            :amount="data.amount"
            :total_value="total_value_tmp">
          </CartItem>
        </div>
        

      <div class="">
        <div class="flex items-center">
          <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path></svg>
          <h1 class="text-2xl uppercase px-4 font-medium">Resumo</h1>
        </div>

        <div class="md:flex p-5">
          <div class="md:w-1/2">
            <h1>Valor dos pedidos:<span class="text-purple-400 text-xl font-medium"> R${{ parseFloat(total_value_tmp).toFixed(2) }}</span></h1>
          </div>
          <div class="md:w-1/2 flex md:justify-end justify-start md:py-0 py-3">  
            <button @click="paymentMethods" class="bg-purple-500 px-2 py-2 rounded-md uppercase flex items-center text-sm">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              <p class="px-2">Ir para o pagamento</p>
            </button>

            <Link class="bg-transparent border border-purple-500 px-2 py-2 mx-2 rounded-md uppercase flex items-center text-sm" :href="$route('index')">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
              <p class="px-2">Continuar comprando</p>
            </Link>
            <div class="cho-container"></div>
          </div>

        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import axios from 'axios'
import Header from './../components/Header.vue'
import Footer from './../components/Footer.vue'
import CartItem from './../components/Cart/Item.vue'

export default {
  mounted(){
    const mp = new MercadoPago('TEST-db91b33a-b08f-4dbc-8fb0-f12a9ec994e2', {
        locale: 'pt-BR'
    });

    // Inicialize o checkout
    mp.checkout({
      preference: {
        id: '268932955-fb7faf99-21e1-42a1-a935-c76561f6993b'
      },
      render: {
        container: '.cho-container', // Indique o nome da class onde será exibido o botão de pagamento
        label: 'Pagar', // Muda o texto do botão de pagamento (opcional)
      }
    });
  },
  data(){
    return {
      total_value_tmp: this.total_value,
      preference_id: null,
    }
  },
  props:{
    products: Array,
    empty: Boolean,
    total_value: Number,
    key: String,
    user: Object,
    address: Object,
  },
  methods: {
    updateTotalValue(variable){
      this.total_value_tmp += variable
      if(this.total_value_tmp <= 0){
        this.empty = true
      }
    },

    paymentMethods(){
      const headers = {
        'Authorization': 'Bearer TEST-2544526114453197-120712-813efe3fa26a8b4bf1b81e7ba07bb491-268932955'
      }

      axios.post('/api/order/payment', {
        headers,
        total_value: this.total_value_tmp,
        user: this.user,
        address: this.address
      }).then((response) => {
        console.log(response.data)
        if(response.data.action == 1){
          window.location.href = this.$route('customer.mydata')
        } else if(response.data.action == 2 && response.data.success){
          this.preference_id = response.data.preference_id
          //window.location.href = response.data.link
        }
      })
    }
  },
  components:{
    Header, Footer, CartItem
  },
}
</script>

