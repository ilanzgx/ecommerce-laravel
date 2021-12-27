<template>
  <div class="bg-purple-500 text-gray-100 py-1 px-1 uppercase">
    <div class="flex font-semibold text-xs md:text-base">
      <div class="w-1/4 flex justify-center">
        <Link :href="$route('home.releases')">Lançamentos</Link>
      </div>
      <div class="w-1/4 flex justify-center">
        <Link :href="$route('home.highlights')">Destaques</Link>
      </div>
      <div class="w-1/4 flex justify-center">
        <Link :href="$route('home.topsellers')">Mais vendidos</Link>
      </div>
      <div class="w-1/4 flex justify-center">
        <Link :href="$route('home.offers')">Ofertas</Link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Categorias'
}
</script>