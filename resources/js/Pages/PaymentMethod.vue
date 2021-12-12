<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2 bg-gray-700 px-3 py-2">
      <div class="flex items-center">
        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path></svg>
        <h1 class="text-2xl uppercase px-4 font-medium">Forma de pagamento</h1>
      </div>

      <div class="md:flex">
        <div class="md:w-1/4">
          <div @click="method = 1" :class="{'bg-purple-500 border-0': method===1}" class="bg-transparent border border-purple-400 px-3 py-2 my-3 cursor-pointer">
            <button class="flex">
              <svg class="w-6 h-6 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              <p class="uppercase font-medium">Pix</p>
            </button>
          </div>

          <div @click="method = 2" :class="{'bg-purple-500 border-0': method===2}" class="bg-transparent border border-purple-400 px-3 py-2 my-3 cursor-pointer">
            <button class="flex">
              <svg class="w-6 h-6 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
              <p class="uppercase font-medium">Boleto Bancário</p>
            </button>
          </div>

          <div :class="{'bg-purple-500 rounded-md border-0': method===3}" class="bg-transparent border border-purple-400 px-3 py-2 my-3 cursor-not-allowed">
            <button class="flex">
              <svg class="w-6 h-6 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
              <p class="uppercase font-medium">Cartão de Crédito</p>
            </button>
          </div>
        </div>

        <div class="md:w-3/4 px-4 py-2">
          <div v-if="method===1">
            <h1 class="font-medium text-2xl">Pix</h1>
            <h2 class="font-medium my-2">A melhor opção para suas compras à vista</h2>
            <p>Nessa modalidade, seu pedido é <span class="font-medium">aprovado instantaneamente</span>, o que torna a expedição do seu pedido ainda mais rápida.</p>

            <div class="flex justify-end items-end">
              <h1 class="uppercase text-xl">Total da sua compra: </h1>
              <h2 class="text-2xl font-semibold text-purple-400">R${{ parseFloat(total_value).toFixed(2) }}</h2>
            </div>
          </div>

          <div v-if="method===2">
            <h1 class="font-medium text-2xl">Boleto Bancário</h1>
            <p class="my-2">Boleto é a forma de pagamento que recebe o maior desconto sob o valor total da compra. Esta é a forma mais vantajosa para quem deseja pagar à vista. Você poderá efetuar o pagamento do boleto em qualquer Banco ou Casa Lotérica em qualquer lugar do Brasil, sem necessidade de confirmação do pagamento.</p>

            <div class="flex justify-end items-end">
              <h1 class="uppercase text-xl">Total da sua compra: </h1>
              <h2 class="text-2xl font-semibold text-purple-400">R${{ parseFloat(total_value).toFixed(2) }}</h2>
            </div>
          </div>

          <div v-if="method===3">
            <h1 class="font-medium text-2xl">Cartão de Crédito</h1>
            <h2 class="font-medium">A melhor opção para suas compras à vista</h2>
            <p></p>
          </div>
        </div>
      </div>

      <div class="flex justify-end">
        <div class="mx-2">
          <Link class="bg-purple-500 w-full px-2 py-2 rounded-md font-medium uppercase flex items-center text-xs" :href="$route('cart')">
            <p class="px-6 py-2">Voltar</p>
          </Link>
        </div>

        <div class="mx-2">
          <button @click="getMethods" class="bg-purple-500 w-full px-2 py-2 rounded-md font-medium uppercase flex items-center text-xs" >
            <p v-if="method===1" class="px-6 py-2">Pagar com Pix</p>
            <p v-else-if="method===2" class="px-6 py-2">Pagar com Boleto</p>
            <p v-else-if="method===3" class="px-6 py-2">Pagar com Cartão</p>
          </button>
        </div>
        
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import axios from 'axios'
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

export default {
  data(){
    return {
      method: 1,
      total: parseFloat(this.total_value).toFixed(2)
    }
  },
  props:{
    image: String,
    data: Array,
    total_value: Number,
    address: Object,
    user: Object
  },
  methods: {
    getMethods(){
      const headers = {
        'Authorization': 'Bearer TEST-2544526114453197-120712-813efe3fa26a8b4bf1b81e7ba07bb491-268932955'
      }

      axios.post('/api/payment/pix', {
        headers,
        total_value: this.total,
        user: this.user,
        address: this.address
      }).then((response) => {
        console.log(response.data)
        if(response.data.success){
          console.log('success');
        }
      })
    }
  },
  components: {
    Header, Footer
  }
}

</script>