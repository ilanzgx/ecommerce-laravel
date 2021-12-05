<template>
  <div>
    <table class="table-auto w-full bg-gray-700 my-4">
      <thead>
        <tr class="md:text-lg border-b border-gray-600 uppercase">
          <th class="border-r border-gray-600">Id Pedido</th>
          <th class="border-r border-gray-600">Id Usuario</th>
          <th class="border-r border-gray-600">Id Produto</th>
          <th class="border-r border-gray-600">Preço</th>
          <th class="border-r border-gray-600">Quantidade</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-600 text-center" v-for="item in data" :key="item.id">
          <td class="px-3">{{ item.id }}</td>
          <td class="px-3">{{ item.customer_id }}</td>
          <td class="px-3">{{ item.product_id }}</td>
          <td class="px-3">{{ item.price }}</td>
          <td class="px-3">{{ item.amount }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
  }
}
</script>

<style>

</style>