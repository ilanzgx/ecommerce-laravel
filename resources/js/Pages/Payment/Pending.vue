<template>
  <div>
    <Header></Header>
    <div class="mx-2 my-4">
      <div class="text-center">
        <h1 class="text-2xl md:text-3xl text-purple-400 font-bold">Aguardando pagamento</h1>
        <h2 class="text-sm">Código do pagamento: {{ data.id }}</h2>
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
  }
}
</script>