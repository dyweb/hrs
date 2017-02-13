<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            Register
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
                    <option v-for="(opt, index) in selectProps[name]" :value="index"> {{ opt }} </option> 
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
                    <span v-for="team_id in member.teamsId" class="label label-entry">
                      {{ (teams.find( t => (t.id === team_id) ) || '').name }}
                    </span>
                  </div>

                  <div class="btn-group">
                    <span class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </span>
                    <ul class="dropdown-menu">
                      <li v-for="team in teams" @click="member.teamsId.push(team.id)">
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
    data () {
      return {
        formProps: [
          'name', 'email', 'nickname', 'gender', 'birthday', 
          'qq', 'phone', 'stdId', 'grade', 'department',
          'GitTq', 'GitHub','QA', 'remark'
          // Goto \App\Member for porperties needed
        ],
        selectProps: {
           gender: ['Male', 'Female', 'Other']  // order here is according to the constant in `\App\Member`
        },
        errors: []
      }
    },
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
            teamsId: [1]
          }
        } 
      }
    },

    methods: {
      submit () {
        let self = this

        axios.post('/members', self.member)
          .then(function (response) {
            // TODO
            alert("succeeed")
          })
          .catch(function (error) {
            if (error.response.status === 422){
              self.errors = error.response.data
              // TODO: roll the page to the first error
            } else {
              console.log("Unknown error happens!")
              console.log(error.response.data)
            }
          })
      },
    },
  }
</script>
