<template>
  <div>
    <Header></Header>
      <div class="bg-gray-700 my-4">
          <div class="bg-red-500 flex justify-center">
            <img class="w-32 h-32" src="/storage/camiseta.png" alt="Camiseta">
          </div>

          <div class="flex justify-center">
            <Link class="bg-indigo-500 px-2 py-2 m-2 rounded-md" :href="$route('cart')">Ir para o carrinho</Link>
            <Link class="bg-indigo-500 px-2 py-2 m-2 rounded-md" :href="$route('index')">Comprar mais</Link>
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
    }
}
</script>