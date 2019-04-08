<template>
  <v-app>
    <v-toolbar app>
      <v-toolbar-title class="headline text-uppercase">
        <span>Twitter Like App</span>
        <span class="font-weight-light"> | sample App</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <router-link to="/"><v-btn　flat>top</v-btn></router-link>
      <router-link to="/profile"><v-btn　flat>profile</v-btn></router-link>
      <router-link to="/login"><v-btn　flat>login</v-btn></router-link>
      <router-link to="/signup"><v-btn　flat>signup</v-btn></router-link>
      <router-link to="/user"><v-btn　flat>user</v-btn></router-link>

    </v-toolbar>
    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>

export default {
  name: 'App',
  data () {
    return {
      //
    }
  }
}
</script>
