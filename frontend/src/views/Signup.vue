<template>
  <v-form v-model="valid" @submit="createAccount">
    <v-container>
      <v-layout>

        <v-flex xs12 md4>
          <v-text-field
            v-model="name"
            label="name"
            browser-autocomplete="on"
            required
          ></v-text-field>
          <v-text-field
            v-model="twitterId"
            label="twitterId"
            browser-autocomplete="on"
            required
          ></v-text-field>
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
            browser-autocomplete="on"
            required
          ></v-text-field>
          <v-text-field
            v-model="pass"
            :rules="passRules"
            label="password"
            browser-autocomplete="on"
            required
          ></v-text-field>
          <v-text-field
            v-model="passConf"
            :rules="passRules"
            label="password_confirm"
            browser-autocomplete="on"
            required
          ></v-text-field>
          <v-btn color="primary" type="submit">createAccount</v-btn>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { CREATE_ACCOUNT } from "../graphql/mutation.js";
  import store from "../store/index";

  export default {
    data: () => ({
      valid: false,
      name: "",
      twitterId: "",
      email: "",
      passConf: "",
      pass: "",
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      passRules: [
        v => !!v || "id is required",
        v => v.length <= 6 || "Name must be less than 6 characters"
      ],

    }),
    methods: {
      createAccount(e){       
        // ミューテーション
        this.$apollo.mutate({
          // Query
          mutation: CREATE_ACCOUNT,
          // Parameters
          variables: {
            name: this.name,
            twitter_id: this.twitterId,
            email: this.email,
            password: this.pass,
            password_confirmation: this.passConf,
          },
        }).then((data) => {
          console.log(data);
          const token = localStorage.setItem("vue_token", data.data.CreateAccount.token.access_token);
          store.commit("logined");
          this.$router.push("/");
        }).catch((error) => {
          // Error
          console.error(error)
        });
      }
    }
  }
</script>