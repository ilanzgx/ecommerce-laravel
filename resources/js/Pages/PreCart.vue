<template>
  <div>
    <Header></Header>
      <div class="bg-gray-700 my-4 mx-2 p-2">
        <div class="flex">
          <div class="w-1/3">
            <img class=" w-72 h-72" :src="data.image" alt="">
          </div>

          <div class="w-1/3 flex items-center">
            <h1 class="text-2xl">{{ data.name }}</h1>
          </div>

          <div class="w-1/3 flex justify-center items-center text-purple-400">
            <div class="text-lg font-medium border-r-2 border-gray-300 px-6">
              <h1>12x R${{ data.price/12 }}</h1>
              <h2>(À prazo: R${{ data.price + 100 }})</h2>
            </div>

            <div class="font-semibold text-xl px-6">
              <h1>R${{ data.price }}</h1>
              <h2>À vista no PIX</h2>
            </div>
          </div>
        </div>

        <div class="text-green-500 flex justify-center items-center uppercase font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 h-8" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <h3 class="mx-2">Produto adicionado ao carrinho</h3>
        </div>

        <div class="p-5 flex justify-center uppercase text-xl font-semibold">
          <Link class="bg-purple-500 px-2 py-2 m-2 rounded-md" :href="$route('cart')">Ir para o carrinho</Link>
          <Link class="bg-purple-500 px-2 py-2 m-2 rounded-md" :href="$route('index')">Continuar comprando</Link>
        </div>
      </div>
    <Footer></Footer>
  </div>
</template>



<script>
import Header from './../components/Header.vue'
import Footer from './../components/Footer.vue'

export default {
    components: {
        Header, Footer
    },
    props: {
      data: Object,
    }
}

/*
<div class="bg-red-500 flex justify-center">
          <img class="w-32 h-32" src="/storage/camiseta.png" alt="Camiseta">
        </div>

        <div class="flex justify-center">
          <Link class="bg-indigo-500 px-2 py-2 m-2 rounded-md" :href="$route('cart')">Ir para o carrinho</Link>
          <Link class="bg-indigo-500 px-2 py-2 m-2 rounded-md" :href="$route('index')">Comprar mais</Link>
        </div>
*/
</script>