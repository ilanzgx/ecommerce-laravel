<template>
  <div>
    <Header></Header>
    <div class="mx-2 my-4">
      <div class="text-center">
        <h1 class="text-2xl md:text-3xl text-purple-400 font-bold">Falha no pagamento</h1>
        <h2 class="text-sm pb-6">Código do pagamento: {{ data.id }}</h2>
      </div>

      <div class="grid md:grid-cols-2 grid-cols-1 gap-4 my-3 mx-3 border-t border-b border-gray-900 p-2 border-opacity-40">
        <div class="text-center" v-for="item in items" :key="item.id">
          <div class="flex justify-center">
            <img class="w-24 h-24" :src="item.image">
          </div>
          <div class="">
            <p class="text-lg font-semibold">{{ item.title }}</p>
            <p>R${{ item.unit_price.toFixed(2) }} x {{ item.quantity }}</p>
          </div>
        </div>
      </div>

      <div class="flex justify-center uppercase font-semibold">
        <Link class="bg-purple-500 py-2 px-4 rounded-md" :href="$route('index')">Voltar à loja</Link>
        <Link class="bg-purple-500 py-2 px-4 ml-4 rounded-md" :href="$route('customer.orders')">Ver meus pedidos</Link>
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
    items: Array
  }
}
</script>