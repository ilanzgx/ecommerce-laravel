<template>
<div class="flex mx-6 my-6">
    <div class="flex flex-col max-w-md m-auto bg-gray-700 px-6 py-6 md:px-8 md:py-6 rounded-md shadow-md">
      <div class="text-center mb-6">
        <h1 class="text-4xl font-bold text-white">Registro</h1>
        <p class="text-gray-400 text-sm">Faça sua conta agora mesmo</p>
      </div>

      <form @submit.prevent="submitForm()" class="text-gray-400 space-y-8">
        <div class="space-y-4">

          <div class="">
            <label class="text-gray-50 text-sm" for="">Nome completo</label>
            <input :class="{'border-red-500': errors != undefined && errors.full_name}" v-model="full_name" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_name" type="text" placeholder="Seu nome completo">
            <div v-if="errors != undefined && errors.full_name">
              <ul v-for="errors in errors.full_name" :key="errors.id">
                <li class="text-red-500 text-sm">{{ errors }}</li>
              </ul>
            </div>
          </div>

          <div class="">
            <label class="text-gray-50 text-sm" for="">Email</label>
            <input :class="{'border-red-500': errors != undefined && errors.email}" v-model="email" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="email" placeholder="Digite um email válido">
            <div v-if="errors != undefined && errors.email">
              <ul v-for="errors in errors.email" :key="errors.id">
                <li class="text-red-500 text-sm">{{ errors }}</li>
              </ul>
            </div>
          </div>

          <div class="">
            <label class="text-gray-50 text-sm" for="">Gênero</label>
            <select :class="{'border-red-500': errors != undefined && errors.genre}" v-model="genre" class="w-full bg-transparent outline-none border px-3 py-2" name="" id="">
              <option class="bg-gray-900 outline-none" value="Selecione seu genero">Selecione seu genero</option>
              <option class="bg-gray-900 outline-none" value="Masculino">Masculino</option>
              <option class="bg-gray-900 outline-none" value="Feminino">Feminino</option>
              <option class="bg-gray-900 outline-none" value="Nao Binario">Não binário</option>
            </select>
            <div v-if="errors != undefined && errors.genre">
              <ul v-for="errors in errors.genre" :key="errors.id">
                <li class="text-red-500 text-sm">{{ errors }}</li>
              </ul>
            </div>
          </div>

          <div class="">
            <label class="text-gray-50 text-sm" for="">Seu CPF</label>
            <input :class="{'border-red-500': errors != undefined && errors.cpf}" v-model="cpf" @input="cpfCheck" maxlength="14" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cpf" placeholder="Digite seu cpf">
            <div v-if="errors != undefined && errors.cpf">
              <ul v-for="errors in errors.cpf" :key="errors.id">
                <li class="text-red-500 text-sm">{{ errors }}</li>
              </ul>
            </div>
          </div>

          <div class="">
            <label class="text-gray-50 text-sm" for="">Data de nascimento</label>
            <input :class="{'border-red-500': errors != undefined && errors.birth_date}" v-model="birth_date" @input="birthDateCheck" minlength="10" maxlength="10" class="bg-transparent outline-none w-full border px-2 py-2" type="text" id="datemin" name="datemin" placeholder="dd/mm/yyyy">
            <div v-if="errors != undefined && errors.birth_date">
              <ul v-for="errors in errors.birth_date" :key="errors.id">
                <li class="text-red-500 text-sm">{{ errors }}</li>
              </ul>
            </div>
          </div>

          <div class="flex">
            <div class="w-1/2">
              <label class="text-gray-50 text-sm" for="">Senha</label>
              <input :class="{'border-red-500': errors != undefined && errors.password}" v-model="password" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senha" placeholder="Crie sua senha">
              <div v-if="errors != undefined && errors.password">
                <ul v-for="errors in errors.password" :key="errors.id">
                  <li class="text-red-500 text-sm">{{ errors }}</li>
                </ul>
              </div>
            </div>

            <div class="w-1/2 ml-2">
              <label class="text-gray-50 text-sm" for="">Confirme a senha</label>
              <input :class="{'border-red-500': errors != undefined && errors.password}" v-model="password_confirmation" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senhaconfirma" placeholder="Confirme a senha">
              <div v-if="errors != undefined && errors.password">
                <ul v-for="errors in errors.password" :key="errors.id">
                  <li class="text-red-500 text-sm">{{ errors }}</li>
                </ul>
              </div>
            </div>
          </div>

          <t-alert v-if="response.message" :variant="response.success ? 'success' : 'danger'" show>
            {{ response.message }}
          </t-alert>
        </div>
        
        <div class="space-y-2">
          <button class="w-full bg-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md" type="submit">
            <div v-if="loading" class="flex justify-center items-center">
              <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
            </div>
            <span v-else>Registrar</span>
          </button>
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
      loading: false,
      full_name: null,
      email: null,
      password: null,
      password_confirmation: null,
      cpf: null,
      genre: 'Selecione seu genero',
      birth_date: null,
      errors: {},
      response: {}
    }
  },
  props:{
    action: String,
  },
  methods: {
    submitForm(){
      this.loading = true
      axios.post('/api/login/signup', {
        full_name: this.full_name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        genre: this.genre,
        birth_date: this.birth_date,
        cpf: this.cpf
      }).then((response) => {
        console.log(response)
        this.errors = response.data.errors
        this.response = response.data
        this.loading = false
        if(response.data.success){
          window.location.href = '/'
        }
      }).catch((error) => {
        this.loading = false
      })

      this.email = null
      this.password = null
      this.password_confirmation = null
    },

    cpfCheck(value){
      if(value.data == null)
        return;

      if(this.cpf.length == 3 || this.cpf.length == 7)
        this.cpf += '.'
      if(this.cpf.length == 11)
        this.cpf += '-'
    },
    birthDateCheck(value){
      if(value.data == null)
        return;

      if(this.birth_date.length == 2 || this.birth_date.length == 5)
        this.birth_date += '/'
    },
  }
}
</script>