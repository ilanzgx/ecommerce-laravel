<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">
      
      <div class="flex items-center uppercase font-semibold my-5 text-justify">
        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        <p class="px-3 md:text-2xl text-lg">Meus dados</p>
      </div>

      <div class="md:flex">
        <div class="md:w-1/2 bg-gray-700 text-gray-50 mr-2 p-2">
          <form @submit.prevent="submitForm()" class="text-gray-400 space-y-12">
            <div class="space-y-4">
            <div class="">
              <p>Nome</p>
              <input v-model="full_name" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_name" type="text" placeholder="Nome completo">
            </div>

            <div class="">
              <p>Email</p>
              <input v-model="email" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="email" placeholder="joaozinho@exemplo.com">
            </div>

            <div class="">
              <p>Gênero</p>
              <select v-model="genre" class="w-full border bg-transparent text-gray-100 outline-none px-3 py-2" name="" id="">
                <option class="bg-gray-900  outline-none" value="Selecione seu genero" selected>Selecione seu genero</option>
                <option class="bg-gray-900  outline-none" value="Masculino">Masculino</option>
                <option class="bg-gray-900  outline-none" value="Feminino">Feminino</option>
                <option class="bg-gray-900  outline-none" value="Nao Binario">Não binário</option>
              </select>
            </div>

            <div class="">
              <p>CPF</p>
              <input v-model="cpf" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cpf" placeholder="CPF ou CNPJ">
            </div>

            <div class="">
              <label for="datemin">Data de nascimento</label>
              <input v-model="birth_date" class="bg-transparent text-gray-100 outline-none w-full border px-2 py-2" type="text" id="datemin" name="datemin" placeholder="dd/mm/yyyy">
            </div>

            <div class="">
              <p>Número do celular</p>
              <input v-model="number" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="tel" id="text_number" placeholder="(DDD) + 9 + Número">
            </div>
            </div>
          
            <div class="space-y-2">
              <button class="w-full bg-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md" type="submit">
                <div v-if="loading" class="flex justify-center items-center">
                  <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
                </div>
                <span v-else>Salvar</span>
              </button>
            </div>
          </form>
        </div>

        <div class="md:w-1/2 bg-gray-700">

        </div>
      </div>

    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import axios from 'axios'
import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'

export default {
  data() {
    return {
      loading: false,
      full_name: this.data.full_name,
      email: this.data.email,
      genre: this.data.genre,
      birth_date: this.data.birth_date,
      cpf: this.data.cpf,
      number: this.data.number
    }
  },
  methods: {
    submitForm(){
      this.loading = true
      axios.post('/api/user/changedata', {
        name: this.full_name,
        email: this.email,
        genre: this.genre,
        birth_date: this.birth_date,
        cpf: this.cpf,
        number: this.number
      }).then((response) => {
        this.loading = false
        if(response.data.success){

        }
      })
    }
  },
  components: {
    Header, Footer
  },
  props: {
    data: Object,
  }
}
</script>