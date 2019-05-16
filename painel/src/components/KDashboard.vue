<template>
  <div class="k-dashboard">
    <k-drawer v-model="openDrawer"/>
    <k-toolbar :userName="userName" @logout="logout" @onClick="toogle"/>
    <router-view></router-view>
  </div>
</template>

<script>
import KToolbar from '../components/KToolbar'
import KDrawer from '../components/KDrawer'
import LocalStorage from '../utils/LocalStorage'
import VueRouter from 'vue-router'

export default {
  name: 'k-dashboard',
  components: {
    KToolbar,
    KDrawer
  },
  data () {
    return {
      userName: "",
      openDrawer: true
    }
  },
  methods: {
    logout(){
      LocalStorage.remove("SESSION_KABUM");
      this.$router.push('/')
    },
    toogle(open){
     this.openDrawer = !this.openDrawer
    }
  },

  beforeRouteEnter (to, from, next) {
    next(vm => {
      let data = LocalStorage.get("SESSION_KABUM");
      if(!data || !!data.session.token){
        vm.$router.push('/')
      }
      vm.userName = data.session.nome

      next();
    }) 
  } 
}
</script>
 

