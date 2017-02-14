<template>
  <div class="huge-table">

      <table v-if="data" class="table-fixed table table-bordered table-hover"> 
        <thead>
          <tr>
            <td v-for="col in fixedColumns">{{ col }}</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(d, ind) in data" @click="$emit('dataClick', ind)">
            <td v-for="col in fixedColumns">{{ format(col, d[col]) }}</td>
          </tr>
        </tbody>
      </table> 

      <div class="table-movable">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td v-for="col in showedColumns">{{ col }}</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(d, ind) in data" @click="$emit('dataClick', ind)">
              <td v-for="col in showedColumns"> {{ format(col, d[col]) }}</td>
            </tr>
          </tbody>
        </table>
      </div>

  </div>
</template>

<script>
  export default {
    name: 'hugeTable',
    props: {
      allColumns: {
        type: Array,  // Array of String, denoting both the column head and the Object prop
        default: []
      },
      fixedColumns: {
        type: Array,  // Array of String
        default: []
      }, 
      showedColumns: {
        type: Array,  // Array of String
        default: []
      },
      data: {
        type: Array,  // Array of Object
        required: true
      },
      formatters: {
        type: Object,  
        default () {
          return {
            foo: (val) => (val.toUpperCase()) // demo 
          }
        }
      }
    },
    methods: {
      format (name, val) {
        let func = this.formatters[name]
        return func ? func(val) : val
      }
    }
  }
</script>


<style>
  /* Bootstrap .table css has already been used */
  .huge-table {
    display: flex;
    white-space: nowrap;
    overflow-x: scroll;
  }  

  .huge-table > .table-fixed {
      width: auto;  /* Override bootstrap .table's width:100% */
      flex-grow: 1;
  }

  .huge-table > .table-movable {
      overflow-x: scroll;
  }
</style>