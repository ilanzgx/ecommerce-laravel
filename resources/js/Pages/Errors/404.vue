<template>
  <div class="">
    <Header></Header>
    
      <div class="flex justify-center mt-20 sm:mt-20 md:mt-40">
        <div>
          <h1 class="text-3xl text-purple-500 font-bold">Esta página não existe</h1>
          <p class="text-lg text-center pb-6">Erro 404</p>
          <div class="text-center border-t-2 border-opacity-10 py-8">
            <Link class="w-full text-center bg-indigo-500 rounded-sm px-2 py-2" :href="$route('index')">Voltar para a loja</Link>
          </div>
          
        </div>
      </div>
    
  </div>
</template>

<script>

import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'

export default {
  components:{
    Header, Footer
  }
}

</script>

<style>

</style>