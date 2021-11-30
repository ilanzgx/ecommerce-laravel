<template>
  <div class="">
    <div class="default-cart-box">
      <div class="w-1/3">
        <img class="w-32 h-32" :src="image">
      </div>

      <div class="w-1/3">
        <p>{{ name }}</p>
        <p>R${{ price }}</p>
      </div>

      <div class="w-1/3">
        <button class="bg-red-500 px-3 py-2 rounded-3xl">Remover</button>
      </div>
    </div>          
  </div>
</template>

<script>
export default {
  props: {
    id: Number,
    name: String,
    image: String,
    description: String,
    category: String,
    price: Number,
    stock: Number,
    discount: Boolean,
    old_price: Number,
  }
}
</script>