<template>
  <div class="">
    <div class="default-cart-box">
      <div class="w-1/3">
        <img class="w-32 h-32" src="/storage/camiseta.png">
      </div>

      <div class="w-1/3">
        <p>Camiseta</p>
        <p>R$50</p>
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
    image: String,
    name: String,
    amount: Number,
    price: Number 
  }
}
</script>