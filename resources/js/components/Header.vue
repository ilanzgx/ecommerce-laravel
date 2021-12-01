<template>
  <!-- Navbar goes here -->
  <nav class="bg-gray-900">
    <div class="max-w-6xl mx-auto">
      <div class="flex justify-between">
        <div class="flex space-x-4">
          <!-- logo -->
          <div>
            <Link class="flex items-center py-3 px-2 text-gray-200" :href="$route('index')">
              <img width="80" height="80" class="mr-2" src="/storage/logo1.png">
              <span>Loja virtual</span>
            </Link>
          </div>
          
          <!-- primary nav -->
          <div class="hidden md:flex items-center space-x-1">
            <div class="py-4 px-3 w-full">
              <input v-on:input="(event) => this.$emit('searchChange', event)" class="w-full bg-transparent ring-1 ring-gray-200 italic text-sm rounded-lg py-2 px-6 focus:outline-none transition duration-250 ease-in-out placeholder-white placeholder-opacity-100 focus:placeholder-opacity-30 focus:ring-2 focus:ring-purple-400" placeholder="O que você procura?" type="text" name="" id="">
            </div>
          </div>
        </div>
        <!-- secondary nav -->
        <div class="hidden md:flex items-center space-x-2">
            <a class="block md:inline no-underline py-4 md:py-0 hover:text-gray-200" href="https://api.whatsapp.com/send?phone=558698252212" target="blank">
              <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
              </svg>
              <small class="mx-2 md:mx-3">Atendimento</small>
            </a>

            <Link :href="$route('cart')" class="block md:inline no-underline py-4 md:py-0 hover:text-gray-200">
              <div class="relative inline-block">
                <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>
                <span v-if="total_products != 0" class="cart-icon">{{ total_products }}</span>
              </div>
              
              <small class="mx-2 md:mx-3">
                Carrinho 
              </small>
            </Link>

            <div v-if="loading">
              <div v-if="loading" class="flex justify-center items-center">
                <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
              </div>
            </div>

            <div v-else class="items-center">
              <div v-if="!session.logged">
                <Link :href="$route('login')" class="font-bold text-purple-50 bg-purple-500 px-3 py-2 rounded-md hover:text-purple-200 no-underline">
                  Login / Cadastro
                </Link>
              </div>

              <div v-else class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                </svg>
                <div class="text-sm px-1">
                  <p class="font-bold">Olá, {{ session.name }}!</p>
                  <Link :href="$route('customer.myaccount')" class="text-purple-400 hover:text-purple-200 no-underline uppercase">
                    Minha Conta
                  </Link> |

                  <Link v-if="session.role == 'administrador'" :href="$route('admin.index')" class="text-purple-400 hover:text-purple-200 no-underline uppercase">
                    Admin <span class="text-white">|</span>
                  </Link>

                  <button @click="logout()" class="text-purple-400 hover:text-purple-200 no-underline uppercase">
                    Sair
                  </button>
                </div>
              </div>
            </div>
            
            
        </div>

        <!-- mobile button -->
        <div class="md:hidden flex items-center">
          <button @click="toggleMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

      </div>
    </div>
    <!-- mobile menu -->
    <div class="px-6 pb-4" :class="{'hidden': !showMenu}">
      <a class="block py-2 px-4 text-sm no-underline hover:text-gray-200 hover:bg-gray-800" href="https://api.whatsapp.com/send?phone=558698252212" target="blank">
        <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
        </svg>
        <small class="mx-2 md:mx-3">Atendimento</small>
      </a>

      <Link :href="$route('cart')" class="block py-2 px-4 text-sm no-underline hover:text-gray-200 hover:bg-gray-800 border-t-2 border-gray-700 hover:border-opacity-30">
        <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
          <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
        <small class="mx-2 md:mx-3">
          Carrinho 
          <span v-if="total_products != 0">(
            <span class="text-purple-500 font-semibold mx-1">
              {{ total_products }}
            </span>)
          </span>
        </small>
      </Link>

      <div v-if="loading">
        <div v-if="loading" class="flex justify-center items-center">
          <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-gray-200"></div>
        </div>
      </div>

      <div v-else>

        <div v-if="!session.logged">
          <Link :href="$route('login')" class="block py-2 px-4 text-sm font-bold text-purple-400 hover:text-purple-200 no-underline hover:bg-gray-800 border-t-2 border-gray-700 hover:border-opacity-30">
            Entrar
          </Link>

          <Link :href="$route('login')" class="block py-2 px-4 text-sm font-bold text-purple-400 hover:text-purple-200 hover:bg-gray-800 border-t-2 border-gray-700 hover:border-opacity-30">
            Cadastrar
          </Link>
        </div>

        <div v-else class="border-t-2 border-gray-700">
          <p class="font-bold">Olá, {{ session.name }}!</p>
          <Link :href="$route('customer.myaccount')" class="text-purple-400 hover:text-purple-200 no-underline uppercase">
            Minha Conta
          </Link> |

          <button @click="logout()" class="text-purple-400 hover:text-purple-200 no-underline uppercase">
            Sair
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- content goes here -->
</template>

<script>
import axios from 'axios'

export default {
  name: 'Cabecalho',
  async mounted(){
    await axios.post('/api/cart/total').then((response) => {
      this.total_products = response.data
    });

    await axios.post('/api/login/header/session').then((response) => {
      this.session = response.data;
      this.loading = false
      console.log(this.session);    
    });
  },
  data(){
    return {
      showMenu: false,
      search: null,
      loading: true,
      total_products: 0,
      session: {},
    }
  },
  methods: {
    toggleMenu(){
      this.showMenu = !this.showMenu
    },

    logout(){
      axios.post('/api/login/logout').then((response) => {
        if(response.data.success){
          window.location.href = '/'
        }
      })
    }
  },
}

</script>

<style scoped>


</style>