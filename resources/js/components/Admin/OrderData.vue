<template>
  <div>
    <h1 class="md:text-2xl text-lg font-semibold uppercase">Consultar pedido pelo ID</h1>
    <form class="mb-4" @submit.prevent="sendData()">
      <div class="flex">
        <div class="w-3/4">
          <input class="text-gray-900 w-full py-2 px-4 rounded-md" placeholder="Insira o id de pagamento" type="text" v-model="paymentid">
        </div>
        <div class="w-1/4 ml-2">
          <button class="bg-purple-500 px-4 py-2 rounded-md" type="submit">Buscar</button>
        </div>
      </div>
      
    </form>

    <div v-if="Object.keys(response).length">
      <div v-for="item in response.data.data.additional_info['items']" :key="item.id">
        <div class="mb-6">
          <Link class="font-medium hover:underline" :href="$route('produto.id', item.id)"> <h1>{{ item.title }}</h1></Link>
          <p>R${{ item.unit_price }}</p>
          <p>{{ item.quantity }} unidade(s)</p>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return {
      paymentid: null,
      response: {},
      errors: {}
    }
  },
  methods: {
    sendData(){
      axios.post(`/api/admin/get/order/data`, {
        id: this.paymentid
      }).then((response) => {
        this.response = response 
        if(response.data.success){

        }
      })
    }
  }
}
</script>