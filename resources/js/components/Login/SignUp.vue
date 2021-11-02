<template>
<div class="flex mx-6 my-6">
    <div class="flex flex-col max-w-md m-auto bg-gray-700 px-14 py-14 md:px-16 md:py-12 rounded-md shadow-md">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white">Registro</h1>
        <p class="text-gray-400 text-sm">Faça sua conta agora mesmo</p>
      </div>

      <form @submit.prevent="submitForm()" class="text-gray-400 space-y-12">
        <div class="space-y-4">
          <div class="">
            <input v-model="full_name" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_name" type="text" placeholder="Nome completo">
          </div>

          <div class="">
            <input v-model="email" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="email" placeholder="joaozinho@exemplo.com">
          </div>

          <div class="">
            <select v-model="genre" class="w-full bg-transparent outline-none px-3 py-2" name="" id="">
              <option class="bg-gray-900 outline-none" value="Selecione seu genero">Selecione seu genero</option>
              <option class="bg-gray-900 outline-none" value="Masculino">Masculino</option>
              <option class="bg-gray-900 outline-none" value="Feminino">Feminino</option>
              <option class="bg-gray-900 outline-none" value="Nao Binario">Não binário</option>
            </select>
          </div>

          <div class="">
            <input v-model="cpf" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cpf" placeholder="CPF ou CNPJ">
          </div>

          <div class="">
            <label for="datemin">Data de nascimento</label>
            <input v-model="birth_date" class="bg-transparent outline-none w-full border px-2 py-2" type="date" id="datemin" name="datemin" min="1900-01-01">
          </div>

          <div class="">
            <input v-model="password" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senha" placeholder="Crie sua senha">
          </div>

          <div class="">
            <input v-model="password_confirmation" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senhaconfirma" placeholder="Confirme a senha">
          </div>

        </div>
        
        <div class="space-y-2">
          <button class="w-full bg-purple-400 text-gray-900 px-8 py-4 rounded-md" type="submit">Registrar</button>
          <p class="px-6 text-sm text-center text-gray-300">Já tem uma conta? 
            <a v-on:click="(event) => this.$emit('mudarEstado', state)" class="text-purple-400 hover:underline font-bold cursor-pointer">Entrar</a>
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
      state: 0,
      full_name: null,
      email: null,
      password: null,
      password_confirmation: null,
      cpf: null,
      genre: 'Selecione seu genero',
      birth_date: null,
    }
  },
  methods: {
    submitForm(){
      axios.post('/api/login/signup', {
        full_name: this.full_name,
        email: this.email,
        password: this.password,
        genre: this.genre,
        birth_date: this.birth_date,
        cpf: this.cpf
      }).then((response) => {
        console.log(response)
      }).catch((error) => {
        console.log(error.response.data)
      })

      this.email = null
      this.password = null
      this.password_confirmation = null
    },
  }
}
</script>