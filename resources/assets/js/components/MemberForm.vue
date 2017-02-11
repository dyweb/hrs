<template>
  <div>
    <form @submit.prevent="submit" class="form-inline">
    <!-- <form action="/members" method="POST"> -->
      <div v-for="name in inputProps" class="form-group">
        <label :for="'input-' + name"> {{ name }} </label>
        <!-- Ugly, however vue don't suppport dynamic typed v-model on input  -->
        <input v-if="name in inputPropsTypedDate"  
          v-model="member[name]" 
          :name="name" :id="'input-' + name" :placeholder="name"
          type="date"
        >
        <input v-else-if="name in inputPropsTypedEmail"
          v-model="member[name]" 
          :name="name" :id="'input-' + name" :placeholder="name"
          type="email"
        >
        <input v-else
          v-model="member[name]" 
          :name="name" :id="'input-' + name" :placeholder="name"
          type="text"
        >
      </div>

      <div v-for="(values, name) in selectProps" class="form-group">
        <label :for="'input-' + name"> {{ name }} </label>
        <select v-model="member[name]" :name="name" :id="'input-' + name">
          <option v-for="(opt, index) in values" :value="{ opt: index }"> {{ opt }} </option> 
        </select>
      </div>
      
      <input type="submit">
    </form>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        inputProps: [
          'name', 'email', 'phone', 'qq', 'GitTq', 
          'Github', 'stdId', 'grade', 'department',
          'birthday', 'QA', 'nickname', 'remark'
        ],
        inputPropsTypedDate : ['birthday'],
        inputPropsTypedEmail : ['email'],
        selectProps: {
           gender: ['Male', 'Female', 'Other']  // order here is according to the constant in `\App\Member`
        }
      }
    },
    props: {
      teams: {
        type: Array,
        default () {
          return []
        }
      },
      member: {
        type: Object,
        default () {
          return {
            name: 'a',
            email: 'a@b',
            phone: 'a',
            qq: 'a',
            GitTq: 'a',
            GitHub: 'a',
            stdId: 'a',
            grade: 'a',
            birthday: '2017-01-01',
            QA: 'a',
            nickname: 'a',
            remark: 'a',

            department: 0,
            gender: 0,
          }
        } 
      }
    },

    methods: {
      submit () {
        axios.post('/members', this.member)
          .then(function (response) {
            alert("succeeed")
          })
          .catch(function (error) {
            console.log(error)
            console.log(error.response.data)
            // TODO: display rrors
          })
      },
    }
  }
</script>
