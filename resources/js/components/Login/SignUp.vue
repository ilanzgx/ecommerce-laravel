<template>
  <div class="flex mx-6 my-6">
    <div class="m-auto bg-gray-700 p-10">
      <h1>Criar conta</h1>
      <h3>Faça sua conta agora mesmo</h3>
      <a v-on:click="(event) => this.$emit('mudarEstado', state)" class="text-purple-400 hover:underline font-bold">Entrar</a>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      state: 0
    }
  }
}
</script>

<style>

</style>