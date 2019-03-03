<template>
  <v-form v-model="valid">
    <v-container>
      <v-layout>

        <v-flex xs12 md4>
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
            required
          ></v-text-field>
          <v-text-field
            v-model="pass"
            :rules="passRules"
            :counter="10"
            label="password"
            required
          ></v-text-field>
          <v-btn color="primary" @click="login">login</v-btn>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { LOGIN } from "../graphql/mutation.js";

  export default {
    data: () => ({
      valid: false,
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
      pass: '',
      passRules: [
        v => !!v || 'id is required',
        v => v.length <= 10 || 'Name must be less than 10 characters'
      ]
    }),
    methods: {
      login(e){       
        // ミューテーション
        this.$apollo.mutate({
          // Query
          mutation: LOGIN,
          // Parameters
          variables: {
            email: this.email,
            password: this.pass
          },
        }).then((data) => {
          const token = localStorage.setItem('vue_token', data.data.Login.access_token);
          this.$router.push("/");
        });
      }
    }
  }
</script>
