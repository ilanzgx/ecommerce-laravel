<template>
  <div class="bg-gray-700 py-2 px-3 mx-1 rounded shadow-xl">
    <Link :href="$route('produto.id', id)">
      <div class="flex justify-center">
        <img class="w-48 h-48" :src="imagem" alt="">
      </div>
    </Link>

    <div>
      <h1 class="text-2xl break-words">{{ nome }}</h1>
    </div>

    <div class="flex gap-2">
      <div class="w-1/2">
        <p class="text-lg text-purple-500 font-extrabold">
          <span v-if="promocao" class="text-sm line-through text-white font-medium">R${{ preco_antigo }}</span> R${{ preco }}
        </p>
      </div>

      <div class="w-1/2">
        <p class="text-sm"><span class="text-lg mr-1">Em estoque</span>{{ estoque }} restantes!</p>
      </div>
    </div>

    <hr class="my-4">
    
    <div class="flex gap-2">
      <div class="w-1/2">
        <button @click="addToCart(id)" type="button" class="relative w-2/3 px-6 py-4 ml-4 overflow-hidden font-semibold rounded bg-gray-100 text-gray-900">Comprar
		      <span v-if="promocao" class="absolute top-0 right-0 px-5 py-1 text-xs tracking-wider text-center uppercase whitespace-no-wrap origin-bottom-left transform rotate-45 -translate-y-full translate-x-1/3 bg-purple-400">-{{ calcularDesconto() }}%</span>
	      </button>
      </div>

      <div class="w-1/2">
        <button type="button" class="flex items-center px-2 py-1 space-x-1">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
						<path d="M453.122,79.012a128,128,0,0,0-181.087.068l-15.511,15.7L241.142,79.114l-.1-.1a128,128,0,0,0-181.02,0l-6.91,6.91a128,128,0,0,0,0,181.019L235.485,449.314l20.595,21.578.491-.492.533.533L276.4,450.574,460.032,266.94a128.147,128.147,0,0,0,0-181.019ZM437.4,244.313,256.571,425.146,75.738,244.313a96,96,0,0,1,0-135.764l6.911-6.91a96,96,0,0,1,135.713-.051l38.093,38.787,38.274-38.736a96,96,0,0,1,135.765,0l6.91,6.909A96.11,96.11,0,0,1,437.4,244.313Z"></path>
					</svg>
					<span>Talvez depois</span>
				</button>
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
      }).catch((error) => {
        console.log(error.console.data)
      });
    }
  },
}
</script>