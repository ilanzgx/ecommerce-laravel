<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">

      <div class="flex items-center uppercase font-semibold my-5 text-justify">
        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        <p class="px-3 md:text-2xl text-lg">Meus pedidos</p>
      </div>

      <div class="my-4"> 
        <div v-for="item in data" :key="item.id" class="my-2 md:flex bg-gray-700 px-3 py-4">
          <div class="md:w-2/12">
            <h1 class="text-lg uppercase font-semibold">Número do pedido</h1>
            <p class="text-sm">#{{ item.payment_id }}</p>
          </div>

          <div class="md:w-2/12">
            <h1 class="text-lg uppercase font-semibold">Status</h1>
            <p class="text-base font-medium" :class="getOrderStatus(item.logistic_status)[1]">{{ getOrderStatus(item.logistic_status)[0] }}</p>
          </div>

          <div class="md:w-2/12">
            <h1 class="text-lg uppercase font-semibold">Data</h1>
            <p class="text-sm">{{ item.created_at | formatDate }}</p>
          </div>

          <div class="md:w-2/12">
            <h1 class="text-lg uppercase font-semibold">Pagamento</h1>
            <p class="text-sm">{{ item.payment_method }} ({{ item.payment_type }})</p>
          </div>

          <div class="md:w-4/12">
            <h1 class="text-lg uppercase font-semibold mb-2">Detalhes do pedido</h1>
            <div class="flex">
              <Link class="text-sm uppercase font-medium bg-purple-500 px-4 py-1 rounded-md" :href="$route('order.payment') + '?payment_id=' + item.payment_id + '&status=' + item.payment_method">Dados do pedido</Link>
              <button v-if="item.logistic_status != 4 || item.logistic_status != 1 || item.logistic_status != 5" @click="showModal=true" class="text-sm uppercase font-medium bg-purple-600 px-4 py-1 rounded-md ml-2">Já recebí o pedido</button>
            </div>

            <t-modal class="text-gray-900" v-model="showModal">
              <p>O pedido <span class="font-semibold">{{ item.payment_id }}</span> realizado em <span class="font-semibold">{{ item.created_at | formatDate }}</span> realmente chegou?</p>
              <button @click="orderReceived(item.id)" class="text-gray-50 bg-purple-600 px-2 py-1 rounded-lg w-full font-medium text-lg mt-6">
                Confirmar
              </button>
            </t-modal>

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
import axios from 'axios'

export default {
  components: {
    Header, Footer
  },
  data(){
    return {
      showModal: false,
    }
  },
  props: {
    data: Array
  },
  methods: {
    getOrderStatus(logistic_status){
      switch(logistic_status){
        case 1:
          return ['Aguardando pagamento', 'text-yellow-500']
          break
        case 2:
          return ['Pagamento aprovado', 'text-green-500']
          break
        case 3:
          return ['Pedido a caminho', 'text-green-600']
          break
        case 4:
          return ['Pedido concluído', 'text-green-700']
          break;
        case 5:
          return ['Pedido cancelado/anulado', 'text-red-500']
        default:
          return ['Pedido cancelado/anulado', 'text-red-500']
      }
    },

    orderReceived(orderid){
      axios.put('/api/admin/set/order/received', {
        id: orderid
      }).then((response) => {
        if(response.data.success){
          window.location.reload()
        }
      })
    }
  }
}
</script>

<style>

</style>