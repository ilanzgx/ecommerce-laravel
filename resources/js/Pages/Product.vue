<template>
  <div class="">
    <Header></Header>
    <div class="flex justify-center bg-gray-700">
      <div class="">
        <h1>{{ datas[0]['nome'] }}</h1>
      </div>

      <div class="flex">
        <div class="w-1/2">
          <img class="w-full h-full" :src="datas[0]['imagem']" alt="">
        </div>

        <div class="w-1/2">
          R${{ datas[0]['preco'] }}
        </div>
      </div>

    </div>
    <Footer></Footer>
  </div>
</template>

<script>

import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

export default {
  components:{
    Header, Footer
  },
  props:{
    product: Array,
  }
}

</script>