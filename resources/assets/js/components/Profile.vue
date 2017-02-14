<template>
  <div class="container">
    <!-- Content -->
    <div v-if="member" class="row">
      <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
          <div class="panel-heading">
            Profile
            <div class="panel-heading-menu">
              <span v-if="allowEdit" @click="showEdit" class="glyphicon glyphicon-edit"></span>
              <span v-if="allowDelete" @click="deleteThisMember" class="glyphicon glyphicon-trash"></span>
            </div>
          </div>
          <div class="panel-body">

            <div v-for="p in memberProps" class="profile-entry">
              <p class="entry-name">{{ p }}</p>
              <p class="entry-content">{{ format(p, member[p]) }}</p>
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

    <!-- Alert -->
    <div v-if="confirming" class="lock-background" @scroll.native.stop>
      <div class="row">
          <div class="col-md-6 col-md-offset-3 alert alert-danger text-center">
            <h2>Are you sure you want to delete member</h2>
            <h2><strong>{{ member.name }}</strong> ?</h2>
            <h2>This operation is <strong>IRREVERSIBLE</strong></h2>
            <hr>
            <button type="button" class="btn btn-danger btn-lg"
              @click="deleteThisMember(true)"
            >
              I' Sure
            </button>
            <button type="button" class="btn btn-default btn-lg"
              @click="deleteThisMember(false)"
            >
              Wait a moment
            </button>
          </div>
      </div>
    </div>

</template>

<script>
  export default {
    props: {  
      member: Object,
      memberProps: Array,
      format: Function,
      allowEdit: {
        type: Boolean,
        default: false
      },
      allowDelete: {
        type: Boolean,
        default: false
      }
    },
    data () {
      return {
        confirming: false
      }
    },
    components: {
      prompt: require('./Prompt.vue')
    },
    methods: {
      showEdit () {
        this.$emit('roll', 'edit', { member: this.member })
      },
      deleteThisMember (confirmed = false) {
        // TODO: require user to type password again
        if (!this.confirming) {
          this.confirming = true  // Ask for confirm
        } else if (!confirmed) {
          this.confirming = false // Confirm failed
        } else {
          let self = this

          axios.delete('/members/' + this.member.id)
            .then(function (response) {
              self.$emit('delete')
              self.$emit('roll', 'prompt', {
                type: 'success',
                title: 'Deletion Succeed',
                message: ''
              })
            })
            .catch(function (error) {
              console.log(error)
              console.log(error.response.data)
              self.$emit('roll', 'prompt', {
                type:'danger',
                title:'Deletion Failed',
                message: error.response.statusText + '. Please contact site attendant'
              })
            })
        }
      },
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

  .lock-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 150%;
    z-index: 1000; /* more than 999 to override Bootstrap navbar */
    background-color: rgba(0, 0, 0, .7);
    padding-top: 150px;
  }

</style>

