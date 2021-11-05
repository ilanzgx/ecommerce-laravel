<template>
  <div class="bg-gray-700 py-2 px-3 mx-1 rounded shadow-xl">

    <div class="flex">
      <h1 class="text-xl break-words">{{ nome }}</h1>
    </div>

    <div class="border border-gray-600 rounded-xl py-4 px-2">
      <Link :href="$route('produto.id', id)">
        <div class="flex justify-center">
          <img class="w-48 h-48" :src="imagem" alt="">
        </div>
      </Link>
    </div>

    <div class="flex items-center justify-center my-2">
      <div class="w-2/3">
        <p class="text-2xl text-purple-400 font-extrabold">
          <span v-if="promocao" class="text-sm line-through text-white font-medium">R${{ preco_antigo }}</span> R${{ preco }}
        </p>
      </div>

      <div v-if="estoque > 0" class="w-1/3">
        <p class="text-xs italic">Estoque disponivel</p>
      </div>

      <div v-else class="w-1/3">
        <p class="text-xs italic text-red-500">Sem estoque</p>
      </div>
    </div>
    
    <div class="gap-2">
      <div v-if="estoque > 0" class="flex items-center justify-center">
        <button @click="addToCart(id)" type="button" class="relative w-full px-6 py-2 overflow-hidden font-semibold rounded-xl bg-transparent hover:bg-gray-800 border border-gray-500 outline-none text-gray-200 hover:text-gray-50 transition duration-200">Comprar
		      <span v-if="promocao" class="absolute top-0 right-0 px-5 py-1 text-xs tracking-wider text-center uppercase whitespace-no-wrap origin-bottom-left transform rotate-45 -translate-y-full translate-x-1/3 bg-purple-500 text-white">-{{ calcularDesconto() }}%</span>
	      </button>
      </div>

      <div v-else class="flex items-center justify-center">
        <button type="button" class="relative w-full px-6 py-2 overflow-hidden font-semibold rounded-xl bg-transparent hover:bg-gray-800 border border-gray-500 outline-none text-gray-200 hover:text-gray-50 cursor-not-allowed" disabled>Sem estoque</button>
      </div>
      
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Item',
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
    addToCart(id){
      axios.post('/api/cart/add', {
        id: this.id
      }).then((response) => {
        console.log(response)
        window.location.href = '/precarrinho/' + response.data;
      }).catch((error) => {
        console.log(error.console.data)
      });
    }
  },
}
</script>