
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


var app = new Vue({
  el: '#app',
  data: {
    members: [],
    teams: [],
    view: 'poster',
    viewkwargs: {} 
  },
  components: {
    appNavbar: require('./components/Navbar.vue'),
    poster: require('./components/Poster.vue'),
    addressBook: require('./components/AddressBook.vue'),
    memberForm: require('./components/MemberForm.vue'),
    profile: require('./components/Profile.vue'),
  },
  methods: {
    rollView (view, kwargs) {
      console.assert(typeof kwargs === 'object', "Only `Object` should be passed as `kwargs` in event 'rollView'")
      this.view = view
      this.viewkwargs = kwargs
    }
  },
  beforeCreate () {
    // TODO: postpone the timing to ajax
    let self = this

    axios.all([(function() {return axios.get('/members')})(), (function () {return axios.get('/teams')})()])
      .then(axios.spread(function (memberResp, teamResp) {
        self.members = memberResp.data
        self.teams = teamResp.data
        // TODO

        if (memberResp.status !== 200) { alert("Failed to get members data") }
        if (teamResp.status !== 200) { alert("Failed to get teams data") }
      }));
  },
  created () {
     ['isGuest', 'isAdmin'].forEach(function (name) {
      this[name] = window[name]
      delete window[name]
     })
  }
});
