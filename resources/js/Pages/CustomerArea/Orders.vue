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
          <div class="md:w-1/5">
            <h1 class="text-lg uppercase font-semibold">Número do pedido</h1>
            <p class="text-sm">#{{ item.payment_id }}</p>
          </div>

          <div class="md:w-1/5">
            <h1 class="text-lg uppercase font-semibold">Status</h1>
            <p class="text-sm font-medium" :class="getOrderStatus(item.status)[1]">{{ getOrderStatus(item.status)[0] }}</p>
          </div>

          <div class="md:w-1/5">
            <h1 class="text-lg uppercase font-semibold">Data</h1>
            <p class="text-sm">{{ item.created_at | formatDate }}</p>
          </div>

          <div class="md:w-1/5">
            <h1 class="text-lg uppercase font-semibold">Pagamento</h1>
            <p class="text-sm">{{ item.payment_method }} ({{ item.payment_type }})</p>
          </div>

          <div class="md:w-1/5">
            <h1 class="text-lg uppercase font-semibold mb-2">Detalhes do pedido</h1>
            <Link class="text-sm bg-purple-500 px-3 py-1 rounded-md my-4" :href="$route('order.payment') + '?payment_id=' + item.payment_id + '&status=' + item.payment_method">Dados do pedido</Link>
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
    data: Array
  },
  methods: {
    getOrderStatus(status){
      switch(status){
        case 'approved':
          return ['Aprovado', 'text-green-500']
          break
        case 'pending':
          return ['Aguardando', 'text-yellow-500']
          break
        case 'cancelled':
          return ['Cancelado', 'text-red-500']
          break
        default:
          return ['Falha', 'text-red-500']
      }
    }
  }
}
</script>

<style>

</style>