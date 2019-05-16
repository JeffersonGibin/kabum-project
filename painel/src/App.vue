<template>
    <v-app>
        <v-content>
          <v-container fluid>
              <router-view>
              </router-view>
          </v-container>
        </v-content>
    </v-app>
</template>

<script>

export default {
  name: 'App',
  data () {
    return {}
  }
}
</script>
 
 <style>
    .container{
        padding: 0;
        margin: 0;
    }
 </style>
 

