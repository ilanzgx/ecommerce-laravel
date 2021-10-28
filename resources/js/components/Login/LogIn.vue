<template>
  <div class="flex mx-6 my-6">
    <div class="flex flex-col max-w-md m-auto bg-gray-700 p-14 md:p-12 rounded-md shadow-md">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white">Entrar</h1>
        <p class="text-gray-400 text-sm">Logue para acessar sua conta</p>
      </div>

      <form class="text-gray-400 space-y-12" action="">
        <div class="space-y-4">
          <div class="">
            <label class="block mb-2 text-gray-200" for="text_email">Endereço de email</label>
            <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-700 focus:ring-opacity-50" id="text_email" type="text" placeholder="Ex: joaozinho@gmail.com">
          </div>

          <div class="flex justify-between mb-2">
            <label class="block text-gray-100" for="text_senha">Senha</label>
            <a class="text-xs hover:underline text-gray-400" href="">Esqueceu sua senha?</a>
          </div>
          <input class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-700 focus:ring-opacity-50" type="password" id="text_senha" placeholder="*****">
        </div>
        
        <div class="space-y-2">
          <button class="w-full bg-purple-400 text-gray-900 px-8 py-4 rounded-md">Entrar</button>
          <p class="px-6 text-sm text-center text-gray-300">Não tem uma conta ainda? 
            <a v-on:click="(event) => this.$emit('mudarEstado', state)" class="text-purple-400 hover:underline font-bold">Criar conta</a>
          </p>
        </div>
        
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      state: 1
    }
  }
}
</script>

<style>

</style>