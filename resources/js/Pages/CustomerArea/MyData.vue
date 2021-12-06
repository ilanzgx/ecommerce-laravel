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
          <div class="flex items-center uppercase font-semibold my-5 text-justify">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <p class="px-3 uppercase">Dados básicos</p>
          </div>
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
              <input v-model="cpf" @input="cpfCheck" maxlength="14" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cpf" placeholder="CPF ou CNPJ">
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
          <div class="flex items-center uppercase font-semibold my-5 text-justify">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <p class="px-3 uppercase">Endereço</p>
          </div>

          <form class="mx-5" @submit.prevent="" action="">
            <div class="flex">
              <div class="w-4/5">
                <label for="">CEP (*)</label>
                <input @input="cepCheck()" maxlength="9" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="cep" type="text">
              </div>

              <div class="w-1/5 flex items-end ml-2">
                <button @click="getCepValues()" class="bg-purple-500 px-2 py-3 rounded-md">Verificar CEP</button>
              </div>
            </div>

            <div>
              <label for="">Identificação (*)</label>
              <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="identificaçao" type="text">
            </div>

            <div class="flex">
              <div class="w-2/3">
                <label for="">Logradouro (*)</label>
                <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="logradouro" type="text">
              </div>
              <div class="w-1/3 ml-2">
                <label for="">Numero (*)</label>
                <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="numero" type="text">
              </div>
            </div>

            <div>
              <label for="">Complemento (*)</label>
              <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="complemento" type="text">
            </div>

            <div>
              <label for="">Ponto de Referência (*)</label>
              <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="ponto_referencia" type="text">
            </div>

            <div>
              <label for="">Bairro (*)</label>
              <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="bairro" type="text">
            </div>

            <div class="flex">
              <div class="w-2/3">
                <label for="">Cidade (*)</label>
                <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="cidade" type="text">
              </div>
              <div class="w-1/3 ml-2">
                <label for="">UF (*)</label>
                <input class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="uf" type="text">
              </div>
            </div>

            <div class="my-4">
              <button class="bg-transparent border border-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md uppercase" type="submit">
                <div v-if="loading" class="flex justify-center items-center">
                  <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
                </div>
                <span v-else>Salvar endereço</span>
              </button>
            </div>
          </form>
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
      number: this.data.number,
      // address
      cep: null,
      identificaçao: null,
      logradouro: null,
      numero: null,
      complemento: null,
      ponto_referencia: null,
      bairro: null,
      cidade: null,
      uf: null,
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
    },

    addressSubmit(){
      axios.post('/api/user/change/address', {
        cep = this.cep,
        identificaçao = this.identificacao,
        logradouro = this.logradouro,
        numero = this.numero,
        complemento = this.complemento,
        ponto_referencia = this.ponto_referencia,
        bairro = this.bairro,
        cidade = this.cidade,
        uf = this.uf,
      }).then((response) => {
        console.log('');
      })
    },

    getCepValues(){
      let cep_tmp = this.cep
      cep_tmp = cep_tmp.replace(/[^0-9]/g, '')
      axios.get(`https://viacep.com.br/ws/${cep_tmp}/json/`).then((response) => {
        console.log(response.data)
        if(response.data.erro != true){
          this.bairro = response.data.bairro
          this.logradouro = response.data.logradouro
          this.complemento = response.data.complemento
          this.cidade = response.data.localidade
          this.uf = response.data.uf
        }
      })
    },

    cepCheck(value){
      if(value.data == null)
        return;
      if(this.cep.length == 5){
        this.cep += '-'
      }

      if(this.cep.length == 9){
        this.getCepValues();
      }

      console.log(value.data, this.cep.length)
    },

    cpfCheck(value){
      if(value.data == null)
        return;

      if(this.cpf.length == 3 || this.cpf.length == 7)
        this.cpf += '.'
      if(this.cpf.length == 11)
        this.cpf += '-'
    },
  },
  components: {
    Header, Footer
  },
  props: {
    data: Object,
  }
}
</script>