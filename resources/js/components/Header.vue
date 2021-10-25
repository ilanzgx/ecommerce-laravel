<template>
  <div class="">
    <header class="bg-gray-800 text-white pt-6 md:py-6">
      <div class="container md:flex md:items-center md:justify-between mx-auto px-4">
        <h1 class="mb-4 md:mb-0 text-2xl">
          <Link :href="$route('index')">
            <img class="w-32" src="/storage/logo2.png">
          </Link>
        </h1>
        <ul class="md:flex md:items-center list-reset text-xl">
          <li class="border-t md:border-t-0 md:ml-4 md:mr-6 text-gray-400 md:text-sm py-0 sm:py-4">
            <div class="md:flex md:items-center">
              <div class="px-2 md:border-r md:border-gray-500">
                <span>
                  <!--<i class="fas fa-user-circle fa-2x"></i>-->
                  <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
</svg>
                </span>
              </div>

              <div class="px-2">
                <span>Faça </span>
                <Link :href="$route('login')" class="md:inline no-underline py-4 md:py-0 font-bold hover:text-gray-200">
                  Login
                </Link>
                <span>ou<br>crie seu </span>
                <Link :href="$route('login')" class="md:inline no-underline py-4 md:py-0 font-bold hover:text-gray-200">
                  Cadastro
                </Link>
              </div>

            </div>
          </li>
          <li class="border-t md:border-t-0 md:ml-4">
            <a class="block md:inline no-underline py-4 md:py-0 hover:text-gray-200" href="https://api.whatsapp.com/send?phone=558698252212" target="blank">
              <!--<i class="fas fa-headphones-alt fa-lg"></i>-->
              <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="inline" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
              </svg>
                <small class="mx-2 md:mx-3">Atendimento</small>
            </a>
          </li>
          <li class="border-t md:border-t-0 md:ml-4">
            <Link :href="$route('carrinho')" class="block md:inline no-underline py-4 md:py-0 hover:text-gray-200">
              <!--<i class="fas fa-shopping-cart fa-lg"></i>-->
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
export default {

}

//
</script>

<style scoped>

</style>