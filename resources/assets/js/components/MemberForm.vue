<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            {{ panelHeading }}
          </div>
          <div class="panel-body">

            <!-- Form -->
            <form @submit.prevent="submit" class="form-horizontal">
              <!-- Regular items -->
              <div v-for="name in formProps" class="form-group" :class="{ 'has-error': errors[name] }" >
                <label :for="'input-' + name" class="col-md-4 control-label"> {{ name }} </label>
              
                <div class="col-md-6">
                  <select v-if="name in selectProps"
                    v-model="member[name]" :name="name" :id="'input-' + name" >
                    <option v-for="val in selectProps[name]" :value="val"> {{ format(name, val) }} </option>
                  </select>
                  <input v-else
                    v-model="member[name]" 
                    :name="name" :id="'input-' + name" :placeholder="name"
                    class="form-control" type="text" required 
                  >
                  <span v-if="errors[name]" class="text-danger">{{ errors[name][0] }}</span>
                </div>
              </div>

              <!-- Teams -->
              <div class="form-group">
                <label for="input-teams" class="col-md-4 control-label"> Teams </label>
                <div class="col-md-6">

                  <div class="btn-group">
                    <span v-for="team in member.teams" class="label label-entry">
                      {{ team.name }} &nbsp;
                      <span class="glyphicon glyphicon-remove" @click="removeTeam(team)"></span>
                    </span>
                  </div>

                  <div class="btn-group">
                    <span class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </span>
                    <ul class="dropdown-menu">
                      <li v-for="team in teams" @click="addTeam(team)">
                        <a href="javascript:void(0)">{{ team.name }}</a>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>

              <!-- Submit -->
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">
                  Submit
                </button>
              </div>

            </form>
            <!-- Form Ends -->

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      teams: {
        type: Array,
        required: true
      },
      member: { // This prop can be skipped when this form is intended to create new member
        // TODO: set default values to empty 
        type: Object, 
        default () {
          return {
            name: 'a',
            email: 'a@b.c',
            phone: '123',
            qq: '456',
            GitTq: 'a',
            GitHub: 'a',
            stdId: 'a',
            grade: 'a',
            birthday: '2017-01-01',
            QA: 'a',
            nickname: 'a',
            remark: 'a',
            department: 'a',
            gender: 0,
          }
        } 
      },
      formProps: Array,
      format: Function,
      mode: {
        type: String,
        default: 'create', // create | edit
        validator (v) {
          return v === 'create' || v === 'edit'
        }
      }
    },
    data () {
      return {
        selectProps: {
           gender: [0, 1, 2]  // order here is according to the constant in `\App\Member`
        },
        errors: [],
      }
    },
    computed: {
      panelHeading () {
        return  this.mode === 'create' ? 'Register' : 'Edit'
      },
      action () {
        return  this.mode === 'create' ? 'store' : 'update'
      }
    },
    methods: {
      addTeam (team) {
        if (this.member.teams.every(t => t.id !== team.id)) {
          this.member.teams.push(team)
        }
      },
      removeTeam (team) {
        let ind = this.member.teams.findIndex(t => t.id === team.id)
        this.member.teams.splice(ind, 1)
      },
      submit () {
        let self = this

        let promise = this.mode === 'create' ?
          axios.post('/members', self.member) :
          axios.put('/members/' + self.member.id, self.member)

        promise.then(function (response) {
            self.$emit(self.action)
            self.$emit('roll', 'prompt', {
                type:'success',
                title:'Succeed',
                message: ''
              })
          })
          .catch(function (error) {
            if (error.response.status === 422){
              self.errors = error.response.data
              // TODO: roll the page to the first error
            } else {
              console.log("Unknown error happens!")
              console.log(error.response.data)
              self.$emit('roll', 'prompt', {
                type:'danger',
                title:'Unknow Error happens',
                message: error.response.statusText + '. Please contact site attendant'
              })
            }
          })
      },
    },
  }
</script>
