<template>
  <div>
    <Header></Header>
    <Categories></Categories>
    <div class="mx-2 my-4">

      <div v-if="empty">
        <h1 class="text-2xl font-medium text-center">Não há nada no catalogo</h1>
      </div>

      <div v-else class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        
        <div v-for="data in products" :key="data.id" class="w-full">
            <Item
              :id="data.id"
              :nome="data.name" 
              :imagem="data.image"
              :descricao="data.description" 
              :categoria="data.category" 
              :preco="data.price" 
              :estoque="data.stock" 
              :promocao="!!data.discount" 
              :preco_antigo="data.old_price">
            </Item>
        </div>

      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../../components/Header.vue'
import Footer from './../../components/Footer.vue'
import Item from './../../components/Store/Item.vue'
import Categories from './../../components/Categories.vue'

export default {
  data(){
    return {
      empty: false
    }
  },
  components:{
    Header, Footer, Categories, Item
  },
  props:{
    products: Array,
  }

}
</script>