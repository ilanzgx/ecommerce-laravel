<template>
  <div class="">
    <Header></Header>
    <div class="m-5">

      <h1 class="text-3xl">{{ product.name }}</h1>
      <div class="text-gray-400 text-sm">
        <span>Produto {{product.id}}</span> | 
        <Link class="underline">Ver descrição completa</Link>
      </div>

      <div class="flex mt-5">
        <div class="w-1/2 flex justify-center">
          <img :src="product.image" class=" w-72 h-72">
        </div>
        <div class="w-1/2">
          <h3 class="mb-3">Vendido e entregue por: <span class="font-semibold">Loja virtual sem nome</span> | <span class=" text-green-500 font-semibold">Em estoque</span></h3>
          <p class="line-through opacity-50 text-sm">De R$<span class="text-lg px-2 text-purple-500">{{ product.old_price }}</span></p>
          <p class="text-lg">Por R$<span class="text-3xl px-2 text-purple-500 font-bold">{{ product.price }}</span> <span class="text-sm">(-{{ calculateDiscount(product.price, product.old_price) }}%)</span></p>
          
          <div class="flex justify-center mt-5">
            <button class="flex bg-purple-500 rounded-lg px-2 py-1 w-full">
              <div class="flex mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>
                <p class="font-semibold px-2">Adicionar ao carrinho</p>
              </div>
            </button>
          </div> 
        </div>
      </div>

      <!-- Descrição -->
      <div class="mt-6">
    
        <div class="flex items-center border-b border-opacity-60 uppercase font-semibold my-5 text-justify">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
          </svg>
          <p class="px-6 text-2xl">Descrição do produto</p>
        </div>
        <p class="font-semibold mb-1">{{ product.name }}</p>
        <p>{{ product.description }}</p>
        <p class="mt-3 font-semibold">Garanta o seu aqui na Loja virtual sem nome!</p>
        
      </div>

      <!-- Infos tecnicas -->
      <div class="mt-6">
    
        <div class="flex items-center border-b border-opacity-60 uppercase font-semibold my-5 text-justify">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
          </svg>
          <p class="px-6 text-2xl">Informações técnicas</p>
        </div>
        
        
      </div>

      <!-- Comentários -->
      <div class="mt-6">
    
        <div class="flex items-center border-b border-opacity-60 uppercase font-semibold my-5 text-justify">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
          </svg>
          <p class="px-6 text-2xl">Avaliações</p>
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
  },
  methods: {
    calculateDiscount(v1, v2){
      return Math.trunc((v2 - v1) / v1 * 100);
    }
  },
}

//:href="$route('')"

</script>