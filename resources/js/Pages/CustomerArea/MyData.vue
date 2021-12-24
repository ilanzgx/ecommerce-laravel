<template>
  <div>
    <Header></Header>
    <div class="my-4 mx-2">
      
      <div class="flex items-center uppercase font-semibold my-5 text-justify">
        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        <p class="px-3 md:text-2xl text-lg">Meus dados</p>
      </div>

      <div class="md:flex">
        <div class="md:w-1/2 bg-gray-700 text-gray-50 mr-2 p-2">
          <div class="flex items-center uppercase font-semibold my-5 text-justify">
            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <p class="px-3 uppercase">Dados básicos</p>
          </div>
          <form @submit.prevent="submitForm()" class="text-gray-400 text-sm space-y-12">
            <div class="space-y-4">
              <div class="">
                <label class="text-gray-50 text-sm">Nome</label>
                <input :class="{'border-red-500': customer_errors != undefined && customer_errors.name}" v-model="full_name" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_name" type="text" placeholder="Nome completo">
                <div v-if="customer_errors != undefined && customer_errors.name">
                  <ul v-for="customer_errors in customer_errors.name" :key="customer_errors.id">
                    <li class="text-red-500 text-sm">{{ customer_errors }}</li>
                  </ul>
                </div>
              </div>

              <div class="">
                <label class="text-gray-50 text-sm">Email</label>
                <input :class="{'border-red-500': customer_errors != undefined && customer_errors.email}" v-model="email" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" id="text_email" type="email" placeholder="joaozinho@exemplo.com">
                <div v-if="customer_errors != undefined && customer_errors.email">
                  <ul v-for="customer_errors in customer_errors.email" :key="customer_errors.id">
                    <li class="text-red-500 text-sm">{{ customer_errors }}</li>
                  </ul>
                </div>
              </div>

              <div class="">
                <label class="text-gray-50 text-sm">Gênero</label>
                <select :class="{'border-red-500': customer_errors != undefined && customer_errors.genre}" v-model="genre" class="w-full border bg-transparent text-gray-100 outline-none px-3 py-2" name="" id="">
                  <option class="bg-gray-900  outline-none" value="Selecione seu genero" selected>Selecione seu genero</option>
                  <option class="bg-gray-900  outline-none" value="Masculino">Masculino</option>
                  <option class="bg-gray-900  outline-none" value="Feminino">Feminino</option>
                  <option class="bg-gray-900  outline-none" value="Nao Binario">Não binário</option>
                </select>
                <div v-if="customer_errors != undefined && customer_errors.genre">
                  <ul v-for="customer_errors in customer_errors.genre" :key="customer_errors.id">
                    <li class="text-red-500 text-sm">{{ customer_errors }}</li>
                  </ul>
                </div>
              </div>

              <div class="">
                <label class="text-gray-50 text-sm">CPF</label>
                <input :class="{'border-red-500': customer_errors != undefined && customer_errors.cpf}" v-model="cpf" @input="cpfCheck" maxlength="14" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="text" id="text_cpf" placeholder="CPF ou CNPJ">
                <div v-if="customer_errors != undefined && customer_errors.cpf">
                  <ul v-for="customer_errors in customer_errors.cpf" :key="customer_errors.id">
                    <li class="text-red-500 text-sm">{{ customer_errors }}</li>
                  </ul>
                </div>
              </div>

              <div class="">
                <label class="text-gray-50 text-sm">Data de nascimento</label>
                <input :class="{'border-red-500': customer_errors != undefined && customer_errors.birth_date}" v-model="birth_date" class="bg-transparent text-gray-100 outline-none w-full border px-2 py-2" type="text" id="datemin" name="datemin" placeholder="dd/mm/yyyy">
                <div v-if="customer_errors != undefined && customer_errors.birth_date">
                  <ul v-for="customer_errors in customer_errors.birth_date" :key="customer_errors.id">
                    <li class="text-red-500 text-sm">{{ customer_errors }}</li>
                  </ul>
                </div>
              </div>

              <div class="">
                <label class="text-gray-50 text-sm">Número de celular</label>
                <input :class="{'border-red-500': customer_errors != undefined && customer_errors.number}" v-model="number" class="w-full text-gray-100 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" type="tel" id="text_number" placeholder="(DDD) + Número">
                <div v-if="customer_errors != undefined && customer_errors.number">
                  <ul v-for="customer_errors in customer_errors.number" :key="customer_errors.id">
                    <li class="text-red-500 text-sm">{{ customer_errors }}</li>
                  </ul>
                </div>
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

        <div id="address" class="md:w-1/2 bg-gray-700 text-gray-50 mr-2 p-2 mt-4 md:mt-0">
          <div class="flex items-center uppercase font-semibold my-5 text-justify">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <p class="px-3 uppercase">Endereço</p>
          </div>

          <form class="mx-5 text-sm" @submit.prevent="" action="">
            <div class="mb-2" v-if="flash.new.length != 0">
              <t-alert variant="danger" show>
                {{ flash.new[0] }}
              </t-alert>
            </div>
            <div class="space-y-2">
            <div class="flex">
              <div class="w-4/5">
                <label for="">CEP (*)</label>
                <input :class="{'border-red-500': address_errors != undefined && address_errors.cep}" @input="cepCheck" maxlength="9" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="cep" type="text">
                <div v-if="address_errors != undefined && address_errors.cep">
                  <ul v-for="address_errors in address_errors.cep" :key="address_errors.id">
                    <li class="text-red-500 text-sm">{{ address_errors }}</li>
                  </ul>
                </div>
              </div>

              <div class="w-1/5 flex items-end ml-2">
                <button @click="getCepValues()" class="bg-purple-500 w-full px-2 py-3 rounded-md">Verificar CEP</button>
              </div>
            </div>

            <div>
              <label for="">Identificação (*)</label>
              <input :class="{'border-red-500': address_errors != undefined && address_errors.identificacao}" placeholder="Ex: Minha casa, trabalho, etc." class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="identificacao" type="text">
              <div v-if="address_errors != undefined && address_errors.identificacao">
                <ul v-for="address_errors in address_errors.identificacao" :key="address_errors.id">
                  <li class="text-red-500 text-sm">{{ address_errors }}</li>
                </ul>
              </div>
            </div>

            <div class="flex">
              <div class="w-2/3">
                <label for="">Logradouro (*)</label>
                <input :class="{'border-red-500': address_errors != undefined && address_errors.logradouro}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="logradouro" type="text">
                <div v-if="address_errors != undefined && address_errors.logradouro">
                  <ul v-for="address_errors in address_errors.logradouro" :key="address_errors.id">
                    <li class="text-red-500 text-sm">{{ address_errors }}</li>
                  </ul>
                </div>
              </div>
              <div class="w-1/3 ml-2">
                <label for="">Numero (*)</label>
                <input :class="{'border-red-500': address_errors != undefined && address_errors.numero}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="numero" type="text">
                <div v-if="address_errors != undefined && address_errors.numero">
                  <ul v-for="address_errors in address_errors.numero" :key="address_errors.id">
                    <li class="text-red-500 text-sm">{{ address_errors }}</li>
                  </ul>
                </div>
              </div>
            </div>

            <div>
              <label for="">Complemento (*)</label>
              <input :class="{'border-red-500': address_errors != undefined && address_errors.complemento}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="complemento" type="text">
              <div v-if="address_errors != undefined && address_errors.complemento">
                <ul v-for="address_errors in address_errors.complemento" :key="address_errors.id">
                  <li class="text-red-500 text-sm">{{ address_errors }}</li>
                </ul>
              </div>
            </div>

            <div>
              <label for="">Ponto de Referência (*)</label>
              <input :class="{'border-red-500': address_errors != undefined && address_errors.ponto_referencia}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="ponto_referencia" type="text">
              <div v-if="address_errors != undefined && address_errors.ponto_referencia">
                <ul v-for="address_errors in address_errors.ponto_referencia" :key="address_errors.id">
                  <li class="text-red-500 text-sm">{{ address_errors }}</li>
                </ul>
              </div>
            </div>

            <div>
              <label for="">Bairro (*)</label>
              <input :class="{'border-red-500': address_errors != undefined && address_errors.bairro}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="bairro" type="text">
              <div v-if="address_errors != undefined && address_errors.bairro">
                <ul v-for="address_errors in address_errors.bairro" :key="address_errors.id">
                  <li class="text-red-500 text-sm">{{ address_errors }}</li>
                </ul>
              </div>
            </div>

            <div class="flex">
              <div class="w-2/3">
                <label for="">Cidade (*)</label>
                <input :class="{'border-red-500': address_errors != undefined && address_errors.cidade}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="cidade" type="text">
                <div v-if="address_errors != undefined && address_errors.cidade">
                  <ul v-for="address_errors in address_errors.cidade" :key="address_errors.id">
                    <li class="text-red-500 text-sm">{{ address_errors }}</li>
                  </ul>
                </div>
              </div>
              <div class="w-1/3 ml-2">
                <label for="">UF (*)</label>
                <input :class="{'border-red-500': address_errors != undefined && address_errors.uf}" class="w-full text-gray-300 px-4 py-2 rounded-md bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-opacity-0 focus:ring-opacity-50" v-model="uf" type="text">
                <div v-if="address_errors != undefined && address_errors.uf">
                  <ul v-for="address_errors in address_errors.uf" :key="address_errors.id">
                    <li class="text-red-500 text-sm">{{ address_errors }}</li>
                  </ul>
                </div>
              </div>
            </div>
            </div>

            <div class="my-2">
              <button @click="addressSubmit" class="w-full bg-transparent border-2 border-purple-500 text-gray-50 font-medium px-8 py-4 rounded-md uppercase" type="submit">
                <span>Salvar endereço</span>
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
      customer_errors: {},
      address_errors: {},
      full_name: this.data.full_name,
      email: this.data.email,
      genre: this.data.genre,
      birth_date: this.data.birth_date,
      cpf: this.data.cpf,
      number: this.data.number,
      // address
      cep: this.address.cep,
      identificacao: this.address.identification,
      logradouro: this.address.logradouro,
      numero: this.address.number,
      complemento: this.address.complement,
      ponto_referencia: this.address.reference_point,
      bairro: this.address.district,
      cidade: this.address.city,
      uf: this.address.uf
    }
  },
  methods: {
    submitForm(){
      axios.post('/api/user/changedata', {
        name: this.full_name,
        email: this.email,
        genre: this.genre,
        birth_date: this.birth_date,
        cpf: this.cpf,
        number: this.number
      }).then((response) => {
        this.customer_errors = response.data.errors
        if(response.data.success){
          window.location.reload()
        }
      })
    },

    addressSubmit(){
      axios.post('/api/user/change/address', {
        cep: this.cep,
        identificacao: this.identificacao,
        logradouro: this.logradouro,
        numero: this.numero,
        complemento: this.complemento,
        ponto_referencia: this.ponto_referencia,
        bairro: this.bairro,
        cidade: this.cidade,
        uf: this.uf,
      }).then((response) => {
        this.address_errors = response.data.errors
        if(response.data.success){
          window.location.reload()
        }
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
    address: Object,
    flash: Object,
  }
}
</script>