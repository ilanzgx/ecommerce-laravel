<template>
  <div class="bg-gray-800 text-gray-50">
    <Header></Header>
    
    <div class="container m-3">
      <div class="grid grid-flow-row grid-cols-1 grid-rows-1 md:grid-cols-3 md:grid-rows-3 auto-rows-max gap-2">
        
        <!--<div class="mr-5 md:mr-0">
          <Item></Item>
        </div>-->

        
        <div v-for="data in datas" :key="data.id" class="mr-5 md:mr-0">
            <Item
              :nome="data.nome" 
              :imagem="data.imagem"
              :descricao="data.descricao" 
              :categoria="data.categoria" 
              :preco="data.preco" 
              :estoque="data.estoque" 
              :promocao="!!data.promocao" 
              :preco_antigo="data.preco_antigo">
            </Item>
        </div>

      </div>
    </div>

    <Footer></Footer>
  </div>
</template>

<script>
import Header from './../components/Header.vue'
//import Categories from './../components/Categories.vue'
import Footer from './../components/Footer.vue'
import Item from './../components/Store/Item.vue'

export default {
  name: 'Inicio',
  data(){
    return{
      a: 'Olá'
    }
  },
  components:{
    Header, Footer, Item
  },
  props:{
    datas: Array,
  }
}
</script>