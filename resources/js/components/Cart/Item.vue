<template>
  <div v-if="amount_tmp >= 1" class="">
    <div class="md:flex border-b border-gray-600 border-opacity-40 p-2 my-2">
      <div class="md:w-1/5 md:block flex justify-center">
        <Link :href="$route('produto.id', id)">
          <img class="w-32 h-32" :src="image">
        </Link>
      </div>

      <div class="md:w-2/5 md:block flex justify-center">
        <Link class=" hover:underline" :href="$route('produto.id', id)">
          <p class="md:text-xl text-lg font-medium">{{ name }}</p>
        </Link>
      </div>

      <div class="md:w-1/5">
        <div class="md:text-sm text-xs flex justify-center">
          <h1>Quantidade</h1>
        </div>

        <div class="flex justify-center my-5 text-lg">

          <button @click="decreaseAmount()" v-if="amount_tmp > 1" class="text-purple-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          </button>

          <button v-else class="text-gray-500 cursor-default">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          </button>
          
          <p class="px-5">{{ amount_tmp }}</p>

          <button @click="increaseAmount()" v-if="amount_tmp < stock" class="text-purple-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </button>

          <button v-else class="text-gray-500 cursor-default">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </button>
        </div>

        <div class="flex justify-center">
          <button @click="removeItem()" class="text-red-500 flex items-center text-xs">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            <p class="uppercase font-semibold">Remover</p>
          </button>
        </div>
      </div>

      <div class="md:w-1/5">
        <div class="flex justify-center">
          <h1>Preço à vista:</h1>
        </div>
        <div class="flex justify-center mt-6">
          <p class="font-semibold text-lg text-purple-400">R${{ price_tmp.toFixed(2) }}</p>
        </div>
      </div>
    </div>          
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return {
      amount_tmp: this.amount,
      price_tmp: this.price,
    }
  },
  props: {
    id: Number,
    name: String,
    image: String,
    original_price: Number,
    price: Number,
    stock: Number,
    amount: Number,
    total_value: Number,
  },
  methods: {
    increaseAmount(){
      if(this.amount_tmp < this.stock){
        this.amount_tmp += 1 

        axios.post('/api/cart/update', {
          product_id: this.id,
          amount: this.amount_tmp
        }).then((response) => {
          if(response.data.success){
            this.price_tmp += parseFloat(this.original_price)
            this.$emit('updateTotal', parseFloat(this.original_price))
          }
        }).catch((error) => {
          console.log(error)
        })
      }
    },

    decreaseAmount(){
      if(this.amount_tmp > 1){
        this.amount_tmp -= 1 

        axios.post('/api/cart/update', {
        product_id: this.id,
        amount: this.amount_tmp
        }).then((response) => {
          if(response.data.success){
            this.price_tmp -= parseFloat(this.original_price)
            this.$emit('updateTotal', parseFloat(this.original_price)*-1)
          }
        }).catch((error) => {
          console.log(error)
        })
      }
    },

    removeItem(){
      if(this.amount_tmp >= 1){
        axios.post('/api/cart/remove', {
          id: this.id
        }).then((response) => {
          console.log(response.data)
          if(response.data.success){
            this.amount_tmp = 0
            this.$emit('updateTotal', parseFloat(this.price_tmp)*-1)
            //window.location.reload() // temporario
          }
        }).catch((error) => {
          console.log(error)
        })
      }
    }
  },
}
</script>