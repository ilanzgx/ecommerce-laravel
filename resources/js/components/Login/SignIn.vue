<template>
  <div class="flex mx-6 my-6">
    <div class="flex flex-col max-w-md m-auto bg-gray-700 px-14 py-14 md:px-12 md:py-12 rounded-md shadow-md">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white">Entrar</h1>
        <p class="text-gray-400 text-sm">Logue para acessar sua conta</p>
      </div>

      <form @submit.prevent="submitForm()" class="text-gray-400 space-y-12">
        <div class="space-y-4">
          <div class="">
            <label class="block mb-2 text-gray-200" for="text_email">Endereço de email</label>
            <input v-model="email" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="text" placeholder="Ex: joaozinho@gmail.com">
          </div>

          <div class="flex justify-between mb-2">
            <label class="block text-gray-100" for="text_senha">Senha</label>
            <Link class="text-xs hover:underline text-gray-400" :href="$route('login.changepassword')">Esqueceu sua senha?</Link>
          </div>
          <input v-model="password" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senha" placeholder="*****">
          <small v-if="(!showError && response != null && response != true)" class="text-red-500">{{ response.data.message }}</small>
        </div>
        
        <div class="space-y-2">
          <button class="w-full bg-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md" type="submit">
            <div v-if="loading" class="flex justify-center items-center">
              <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
            </div>
            <span v-else>Entrar</span>
          </button>
          <p class="px-6 text-sm text-center text-gray-300">Não tem uma conta ainda? 
            <a v-on:click="(event) => this.$emit('mudarEstado', state)" class="text-purple-400 hover:underline font-bold cursor-pointer">Criar conta</a>
          </p>
        </div>
        
        
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return{
      state: 1,
      email: null,
      password: null,
      response: null,
      loading: false,
      showError: 0
    }
  },
  methods: {
    submitForm(){
      this.loading = true
      axios.post('/api/login/signin', {
        email: this.email,
        password: this.password
      }).then((response) => {
        this.response = response
        this.loading = false
        console.log(response)
        if(response.data.success){
          window.location.href = '/'
        }
      }).catch((error) => {
        console.log(error.response.data)
      })

      this.email = null
      this.password = null
    }
  },
}
</script>