<template>
  <div class="bg-gray-700 py-2 px-3 mx-1 rounded shadow-xl">

    <div class=" rounded-xl py-4 px-2">
      <Link :href="$route('produto.id', id)">
        <div class="flex justify-center">
          <img class="w-48 h-48" :src="imagem" alt="">
        </div>
      </Link>
    </div>

    <div class="flex">
      <h1 class="text-base break-words">{{ nome }}</h1>
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

		      <span v-if="promocao" class="absolute top-0 right-0 px-5 py-1 text-xs tracking-wider text-center uppercase whitespace-no-wrap origin-bottom-left transform rotate-45 -translate-y-full translate-x-1/3 bg-gray-200 text-purple-700">-{{ calcularDesconto() }}%</span>
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
  },
  methods: {
    calcularDesconto(){
      return Math.trunc((this.preco_antigo - this.preco) / this.preco * 100);
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
    }
  },
}
</script>