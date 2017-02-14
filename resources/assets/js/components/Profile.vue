<template>
  <div class="container">
    <!-- Content -->
    <div v-if="member" class="row">
      <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
          <div class="panel-heading">
            Profile
            <div class="panel-heading-menu">
              <span v-if="allowEdit" class="glyphicon glyphicon-edit"></span>
              <span v-if="allowDelete" class="glyphicon glyphicon-trash"></span>
            </div>
          </div>
          <div class="panel-body">

            <div v-for="col in allColumns" class="profile-entry">
              <p class="entry-name">{{ col }}</p>
              <p class="entry-content">{{ member[col] }}</p>
            </div>
          
          </div>
        </div>

      </div>
    </div>

    <prompt v-else 
      type="danger"
      :title="'Member not exists'"
      :message="'Member with id `' + $memberId + '` not found'"
    >
    </prompt>
</template>

<script>
  export default {
    props: {  
      'member': Object,
      'allowEdit': {
        type: Boolean,
        default: false
      },
      'allowDelete': {
        type: Boolean,
        default: false
      }
    },
    data () {
      return {
        memberId: -1,
        member: {},
        allColumns: [
          'name', 'email', 'nickname', 'gender', 'birthday', 
          'qq', 'phone', 'stdId', 'grade', 'department',
          'GitTq', 'GitHub','QA', 'remark'
        ],
      }
    },
    created () {
      this.memberId = this.kwargs.memberId
      this.member = this.members[this.kwargs.memberId] 
    },
    components: {
      prompt: require('./Prompt.vue')
    }
  }
</script>

<style>
  .entry-name,
  .entry-content {
    display: inline-block;
    box-sizing: border
  }

  .entry-name {
    text-align: right;
    width: 29%;
  }
  .entry-content {
    text-align: center;
    width: 69%;
  }
</style>

