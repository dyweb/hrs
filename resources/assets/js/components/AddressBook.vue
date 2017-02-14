<template>
  <div class="container">

    <!-- Table menu -->
    <div class="table-menu text-right form-group">

      <!-- Team filter -->
      <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false">
           {{ teamToDisplay.name }} <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li v-for="team in teams"><a>
              <label>
                <input type="radio" :value="{ id:team.id, name: team.name }" v-model="teamToDisplay">
                {{ team.name }}
              </label>
          </a></li>
          <li><a>
            <label>
              <input type="radio" :value="{ id:0, name: 'All'}"  v-model="teamToDisplay">
              All
            </label>
          </a></li>
        </ul>
      </div>

      <!-- Toggle columns -->
      <div v-for="(cols, ind) in [fixedBools, showedBools]" class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false">
           {{ ['Fix', 'Display'][ind] }} <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li v-for="(col, ind) in allColumns" @click.stop.prevent="toggleColumn(cols, ind)"><a>
              <label>
                <input type="checkbox" :checked="cols[ind]" disabled>
                {{ col }}
              </label>
          </a></li>
        </ul>
      </div>

      <!-- Create new member -->
      <div v-if="allowCreate" class="btn-group">
        <button type="button" class="btn btn-default"
          @click="showCreate"
        >
          New
        </button>
      </div> 

    </div>

    <!-- Table -->
    <huge-table
      :allColumns="allColumns"
      :fixedColumns="fixedColumns"
      :showedColumns="showedColumns"
      :formatters="formatters"
      :data="membersToDisplay"
      @dataClick="showProfile"
    ></huge-table>

  </div>
</template>

<script>
  export default {
    props: {
      members: Array,
      teams: Array,
      allColumns: Array,
      formatters: Object,
      allowCreate: Boolean
    },
    data () {
      return {
        fixedBools: [],   // Tow boolean array representing a column's display state
        showedBools: [],    // calced when mounted to avoid hardcoding a long bool array
        teamToDisplay: { id:0, name:'All' }  // Team filter, show all by default
      }
    },
    mounted () {
      this.fixedBools = this.toBools(['nickname'])
      this.showedBools = this.toBools([
          'name', 'email', 'gender', 'birthday', 
          'qq', 'phone', 'stdId', 'grade', 'department',
          'GitTq', 'GitHub','QA', 'remark', 'id', 'teams' 
        ])  // order not concerned, displaying according to `allColumns`
    },
    computed: {
      fixedColumns () {
        return this.allColumns.filter((col, ind) => this.fixedBools[ind])
      },      
      showedColumns () {
        return this.allColumns.filter((col, ind) => this.showedBools[ind])
      },
      membersToDisplay () {
        let tid = this.teamToDisplay.id
        if (tid == 0){ // Members in all teams
          return this.members;
        } else {
          return this.members.filter(mem => mem.teams.findIndex(team => team.id === tid) > -1)
        }
      }
    },
    methods: {
      toBools (columns) {
        return Array.from(this.allColumns, val => columns.includes(val))
      },
      toggleColumn (cols, ind) {
        // Do not use cols[ind] = xxx to modify array
        // which can not trigger Vue's watcher!
        Vue.set(cols, ind, !cols[ind])
        
        // one column should not be simultaneously fixed and movable
        if (cols[ind]) {
          let otherTypeOfCols = (cols === this.showedBools ? this.fixedBools : this.showedBools)
          Vue.set(otherTypeOfCols, ind, false)
        }
      },
      showProfile (ind) {
        this.$emit('roll', 'profile', { member: this.membersToDisplay[ind] })
      },
      showCreate () {
        this.$emit('roll', 'create')
      }
    },
    components: {
      hugeTable: require('./HugeTable.vue'),
    },
  }
</script>

<style>
  .table-menu {
    text-align: right;
  }
</style>

