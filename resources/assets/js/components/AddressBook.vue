<template>
  <div class="container">

    <div class="table-menu text-right form-group">
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

    </div>

    <!-- Table -->
    <huge-table
      :allColumns=allColumns
      :fixedColumns="fixedColumns"
      :showedColumns="showedColumns"
      :data="membersToDisplay"
      @dataClick="showProfile"
    ></huge-table>

  </div>
</template>

<script>
  export default {
    props: ['members', 'teams'],
    data () {
      return {
        allColumns: [
          'name', 'email', 'nickname', 'gender', 'birthday', 
          'qq', 'phone', 'stdId', 'grade', 'department',
          'GitTq', 'GitHub','QA', 'remark', 'id'
        ],
        fixedBools: [],  // calced when mounted to avoid hardcoding a long bool array
        showedBools: [],
        teamToDisplay: { id:0, name:'All' }
      }
    },
    mounted () {
      this.fixedBools = this.toBools(['nickname'])
      this.showedBools = this.toBools([
          'name', 'email', 'gender', 'birthday', 
          'qq', 'phone', 'stdId', 'grade', 'department',
          'GitTq', 'GitHub','QA', 'remark', 'id'
        ])
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

