
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
  el: '#app',
  data: {
    members: [],
    memberProps: [
      'id', 'name', 'email', 'nickname', 'gender', 'birthday', 
      'qq', 'phone', 'stdId', 'grade', 'department',
      'GitTq', 'GitHub','QA', 'remark', 'created_at',
      'teams' // When rendering, order of this array counts!
    ],
    memberCreateProps: [  // props needed when creating new member
      'name', 'email', 'nickname', 'gender', 'birthday', 
      'qq', 'phone', 'stdId', 'grade', 'department',
      'GitTq', 'GitHub','QA', 'remark'
    ],
    memberFormatters: {
      gender (val) { return ['Male', 'Female', 'Others'][val] },  // according to `App\Models\Member` constants
      teams (val) { return val.length ? Array.from(val, t=>t.name).join(', ') : 'No Team'}
    },
    teams: [],

    view: 'addressBook',
    viewkwargs: {}
  },
  components: {
    prompt: require('./components/Prompt.vue'),
    appNavbar: require('./components/Navbar.vue'),
    poster: require('./components/Poster.vue'),
    addressBook: require('./components/AddressBook.vue'),
    memberForm: require('./components/MemberForm.vue'),
    profile: require('./components/Profile.vue'),
  },
  methods: {
    rollView (view, kwargs) {
      this.view = view
      if ( kwargs ) {
        console.assert(typeof kwargs === 'object', 
          "Only `Object` not `" + typeof kwargs + "` should be passed as `kwargs` in event 'rollView'")
        this.viewkwargs = _.cloneDeep(kwargs)
      }
    },
    format (name, val) {
        let func = this.memberFormatters[name]
        return func ? func(val) : val
    },
    refreshMembers () {
      let self = this

      axios.get('/members')
        .then(function (resp) {
          self.members = resp.data
          if (resp.status !== 200) { console.log("Failed to refresh members data") }
        });
    },
    refreshTeams () {
      let self = this
      axios.get('/teams')
        .then(function (resp) {
          self.members = resp.data
          if (resp.status !== 200) { console.log("Failed to refresh teams data") }
        });
    }
  },
  created () {
    // this.refreshMember()
    // this.refreshTeam()

    Object.assign(this, window.bladeVar)
    delete window.bladeVar
  }
});
