<template>
  <div class="flex mx-6 my-6">
    <div class="flex flex-col max-w-md m-auto bg-gray-700 px-6 py-6 md:px-8 md:py-6 rounded-md shadow-md">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white">Entrar</h1>
        <p class="text-gray-400 text-sm">Logue para acessar sua conta</p>
      </div>

      <form @submit.prevent="submitForm()" class="text-gray-400 space-y-12">
        <div class="space-y-4">
          <div class="">
            <label class="block mb-2 text-gray-50" for="text_email">Endereço de email</label>
            <input :class="{'border-red-500': errors != undefined && errors.email}" v-model="email" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="text" placeholder="Ex: joaozinho@gmail.com">
            <div v-if="errors != undefined && errors.email">
              <ul v-for="errors in errors.email" :key="errors.id">
                <li class="text-red-500 text-sm">{{ errors }}</li>
              </ul>
            </div>
          </div>

          <div class="flex justify-between">
            <label class="block text-gray-50" for="text_senha">Senha</label>
            <span @click="showModal=true" class="text-xs hover:underline text-gray-400 cursor-pointer">Esqueceu sua senha?</span>
          </div>
          <input :class="{'border-red-500': errors != undefined && errors.password}" v-model="password" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="password" id="text_senha" placeholder="*****">
          <div v-if="errors != undefined && errors.password">
            <ul v-for="errors in errors.password" :key="errors.id">
              <li class="text-red-500 text-sm">{{ errors }}</li>
            </ul>
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
            <span v-else>Entrar</span>
          </button>
          <p class="px-6 text-sm text-center text-gray-300">Não tem uma conta ainda? 
            <a v-on:click="(event) => this.$emit('mudarEstado', state)" class="text-purple-400 hover:underline font-bold cursor-pointer">Criar conta</a>
          </p>
        </div>
        
      </form>

      <t-modal class="text-black" v-model="showModal">
        <form @submit.prevent="resetPassword">
          <h1 class="text-3xl text-purple-500 text-center font-medium mb-4">Esqueci a senha</h1>
          <p>Digite seu e-mail de cadastro abaixo e clique em enviar.</p>
          <p>Nós lhe enviaremos um e-mail com link para recadastrar sua senha.</p>

          <div>
            <label class="text-gray-900 text-sm" for="">Email</label>
            <input :class="{'border-red-500': errorsModal != undefined && errorsModal.emailModal}" class="w-full text-gray-900 px-4 py-2 rounded-md bg-transparent border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-opacity-0 focus:ring-opacity-50" v-model="emailModal" type="text">
            <div v-if="errorsModal != undefined && errorsModal.emailModal">
              <ul v-for="errorsModal in errorsModal.emailModal" :key="errorsModal.id">
                <li class="text-red-500 text-sm">{{ errorsModal }}</li>
              </ul>
            </div>
          </div>

          <p :class="{'text-purple-500': responseModal.success}" class="text-red-500 text-sm font-semibold">{{ responseModal.message }}</p>

          <button class="w-full bg-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md mt-8" type="submit">
            Enviar
          </button>
        </form>
      </t-modal>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return{
      state: 1,
      email: '',
      password: '',
      response: {},
      loading: false,
      showError: 0,
      errors: {},
      errorsModal: {},
      responseModal: {},
      showModal: false,
      emailModal: '',
    }
  },
  props:{
    action: String,
  },
  methods: {
    submitForm(){
      this.loading = true
      axios.post('/api/login/signin', {
        email: this.email,
        password: this.password
      }).then((response) => {
        this.loading = false
        this.response = response.data
        this.errors = response.data.errors
        console.log(response)
        if(response.data.success){
          window.location.href = '/'
        }
      }).catch((error) => {
        this.loading = false
      })

      //this.email = null
      this.password = null
    },
    resetPassword(){
      axios.post('/api/password/forget', {
        emailModal: this.emailModal
      }).then((response) => {
        this.responseModal = response.data
        this.errorsModal = response.data.errors
      })
    }
  },
}
</script>