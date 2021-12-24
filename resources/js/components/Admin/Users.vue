<template>
  <div>
    <h1 class="md:text-2xl text-lg font-semibold uppercase">Usuários cadastrados</h1>
    <t-table :headers="['ID', 'Nome', 'Email', 'Cargo', 'Numero', 'Registro']" :data="data" class="text-gray-900">
      <template slot="row" slot-scope="props">
        <tr>
          <td :class="props.tdClass">
            {{ props.row.id }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.full_name }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.email }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.role }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.number }}
          </td>
          <td :class="props.tdClass">
            {{ props.row.created_at | formatDate }}
          </td>
        </tr>
      </template>
    </t-table>
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
  }
}
</script>