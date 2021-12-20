<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">
      <div class="text-center">
        <h1 class="text-3xl font-medium flex justify-center items-center">
          Conta ativada
          <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-12 w-12 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </h1>
        <p class="mb-8">Sua conta acaba de ser ativada através do email.</p>

        <Link class="bg-purple-500 px-12 py-1 rounded-md uppercase font-medium text-sm" :href="$route('index')">Voltar à loja</Link>
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
  }
}
</script>