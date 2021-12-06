<template>
  <div>
    <h1 class="md:text-2xl text-lg font-semibold uppercase">Usuários cadastrados</h1>
    <table class="table-auto w-full bg-gray-700 my-4">
      <thead>
        <tr class="md:text-lg border-b border-gray-600 uppercase">
          <th class="border-r border-gray-600">Id</th>
          <th class="border-r border-gray-600">Nome</th>
          <th class="border-r border-gray-600">Email</th>
          <th class="border-r border-gray-600">Cargo</th>
          <th class="border-r border-gray-600">Numero</th>
          <th class="border-r border-gray-600">Registro</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-600 text-center" v-for="item in data" :key="item.id">
          <td class="px-3">{{ item.id }}</td>
          <td class="px-3">{{ item.full_name }}</td>
          <td class="px-3">{{ item.email }}</td>
          <td class="px-3">{{ item.role }}</td>
          <td class="px-3">{{ item.number }}</td>
          <td class="px-3">{{ item.created_at | formatDate }}</td>
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