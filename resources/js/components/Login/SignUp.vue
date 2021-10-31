<template>
<div class="flex mx-6 my-6">
    <div class="flex flex-col max-w-md m-auto bg-gray-700 px-14 py-14 md:px-16 md:py-12 rounded-md shadow-md">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white">Registro</h1>
        <p class="text-gray-400 text-sm">Faça sua conta agora mesmo</p>
      </div>

      <form class="text-gray-400 space-y-12" action="">
        <div class="space-y-4">
          <div class="">
            <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="text" placeholder="joaozinho@exemplo.com">
          </div>

          <div class="">
            <input class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senha" placeholder="Crie sua senha">
          </div>

          <div class="">
            <input class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senhaconfirma" placeholder="Confirme a senha">
          </div>

          <div class="">
            <input class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cpf" placeholder="CPF ou CNPJ">
          </div>

          <div class="">
            <input class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cep" placeholder="CEP">
          </div>
          
        </div>
        
        <div class="space-y-2">
          <button class="w-full bg-purple-400 text-gray-900 px-8 py-4 rounded-md">Entrar</button>
          <p class="px-6 text-sm text-center text-gray-300">Já tem uma conta? 
            <a v-on:click="(event) => this.$emit('mudarEstado', state)" class="text-purple-400 hover:underline font-bold cursor-pointer">Entrar</a>
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
      state: 0
    }
  }
}
</script>

<style>

</style>