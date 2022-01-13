<template>
  <div class="bg-gray-700 py-2 px-3 mx-1 rounded shadow-xl">

    <div class="flex justify-end items-center">
      <svg :class="{'text-purple-500': averageStars() >= 1}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
      <svg :class="{'text-purple-500': averageStars() >= 2}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
      <svg :class="{'text-purple-500': averageStars() >= 3}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
      <svg :class="{'text-purple-500': averageStars() >= 4}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
      <svg :class="{'text-purple-500': averageStars() >= 5}" xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
      <span class="text-gray-400 text-sm ml-2 font-semibold">( {{ total }} )</span>
    </div>

    <div class="rounded-xl py-4 px-2">
      <Link :href="$route('produto.id', id)">
        <div class="flex justify-center">
          <img class="w-48 h-48" :src="imagem" alt="">
        </div>
      </Link>
    </div>

    <div class="flex">
      <Link :href="$route('produto.id', id)">
        <h1 class="text-base break-words font-semibold">{{ nome }}</h1>
      </Link>
    </div>

    <div class="flex items-center justify-center my-5">
      <div class="w-2/3">
        <p class="text-2xl text-purple-400 font-extrabold">
          <span v-if="promocao" class="text-sm line-through text-white font-medium">R${{ preco_antigo }}</span> R${{ preco }}
        </p>
      </div>

      <div v-if="estoque > 0" class="w-1/3">
        <p class="text-xs">{{ estoque }} restantes</p>
      </div>

      <div v-else class="w-1/3">
        <p class="text-xs text-red-500">Sem estoque</p>
      </div>
    </div>
    
    <div class="gap-2">
      <div v-if="estoque > 0" class="flex items-center justify-center mt-5">
        <button @click="addToCart(id)" type="button" class="relative flex w-full px-6 py-2 overflow-hidden font-semibold rounded-xl bg-purple-500 outline-none text-gray-200 hover:text-gray-50">
          <div v-if="loading" class="flex justify-center items-center">
            <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
          </div>
          
          <div class="mx-auto flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
              <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            <span class="ml-1">Comprar</span>
          </div>

		      <span v-if="promocao" class="absolute top-0 right-0 px-5 py-1 text-xs tracking-wider text-center uppercase whitespace-no-wrap origin-bottom-left transform rotate-45 -translate-y-full translate-x-1/3 bg-gray-200 text-purple-700">{{ calcularDesconto() }}%</span>
	      </button>
        
      </div>

      <div v-else class="flex items-center justify-center">
        <button type="button" class="relative w-full px-6 py-2 overflow-hidden font-semibold rounded-xl bg-transparent bg-gray-500 border border-gray-500 outline-none text-gray-200 cursor-not-allowed" disabled>Indisponível</button>
      </div>
      
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Item',
  data(){
    return {
      loading: false,
      total: 0,
    }
  },
  props: {
    id: Number,
    nome: String,
    imagem: String,
    descricao: String,
    categoria: String,
    preco: Number,
    estoque: Number,
    promocao: Boolean,
    preco_antigo: Number,
    assessments: Array,
  },
  methods: {
    
    calcularDesconto(){
      return Math.trunc((this.preco_antigo - this.preco) / this.preco * 100);
    },
    averageStars(){
      return Math.round(this.totalStars / this.totalAssessments)
    },
    async addToCart(id){
      this.loading = true;
      await axios.post('/api/cart/add', {
        id: this.id
      }).then((response) => {
        console.log(response)
        this.loading = false;
        window.location.href = '/precarrinho/' + response.data;
      }).catch((error) => {
        this.loading = false;
        console.log(error.console.data)
      });
    },
    
  },
  computed: {
    totalAssessments: function(){
      for(let i=0; i < this.assessments.length; i++){
        this.total += 1
      }
      return this.total
    },
    totalStars: function(){
      let sum = 0
      return this.assessments.reduce((sum, item) => sum + item.stars, 0)
    },
  }
}
</script>