<template>
  <div class="">
    <header class="bg-gray-900 text-white pt-4 md:py-4">

      <div class="container md:flex md:items-center md:justify-between mx-auto px-4">
        <h1 class="md:w-2/12 mb-4 md:mb-0 text-2xl sm:text-center md:text-left">
          <Link :href="$route('index')">
            <img class="w-24 h-24" src="/storage/logo1.png">
          </Link>
        </h1>

        <div class="md:w-2/4 text-white mb-4">
          <div class="relative">
            <input class="w-full bg-transparent ring-1 ring-gray-200 italic text-sm rounded py-2 px-4 focus:outline-none transition duration-250 ease-in-out placeholder-white placeholder-opacity-100 focus:placeholder-opacity-30 focus:ring-2 focus:ring-purple-400" placeholder="O que você procura?" type="text" name="" id="">
            
            <span class="absolute inset-y-0 right-0 flex items-center">
              <button type="button" title="search" class="p-4 focus:outline-none focus:ring">
                <svg fill="currentColor" viewBox="0 0 512 512" class="w-4 h-4 dark:text-coolGray-100">
                  <path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z"></path>
                </svg>
              </button>
            </span>
          </div>
        </div>

        <ul class="md:flex md:items-center md:w-1/2 list-reset text-xl border-t md:border-t-0">
          <li class="border-t md:border-t-0 md:ml-4 md:mr-6 text-gray-400 md:text-sm py-0 sm:py-4">
            <div class="md:flex md:items-center">
              <div class="px-2 md:border-r md:border-gray-500">
                <span>
                  <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                  </svg>
                </span>
              </div>

              <div class="px-2">
                <span>Faça </span>
                <Link :href="$route('login')" class="inline-block font-bold text-purple-500 hover:text-purple-900 no-underline py-4 md:py-0">
                  Login
                </Link>
                <span>ou<br>crie seu </span>
                <Link :href="$route('login')" class="inline-block font-bold text-purple-500 hover:text-purple-900 no-underline py-4 md:py-0 ">
                  Cadastro
                </Link>
              </div>

            </div>
          </li>
          <li class="border-t md:border-t-0 md:ml-4">
            <a class="block md:inline no-underline py-4 md:py-0 hover:text-gray-200" href="https://api.whatsapp.com/send?phone=558698252212" target="blank">
              <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
              </svg>
                <small class="mx-2 md:mx-3">Atendimento</small>
            </a>
          </li>
          <li class="border-t md:border-t-0 md:ml-4">
            <Link :href="$route('carrinho')" class="block md:inline no-underline py-4 md:py-0 hover:text-gray-200">
              <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
              </svg>
                <small class="mx-2 md:mx-3">Carrinho</small>
            </Link>
          </li>
        </ul>
      </div>
    </header>
  </div>
</template>

<script>
//import Categories from './Categories.vue'

export default {
  name: 'Cabecalho',
  components: [
    
  ]
}

</script>

<style scoped>

</style>