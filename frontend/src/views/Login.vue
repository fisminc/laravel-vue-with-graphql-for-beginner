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
  import gql from 'graphql-tag';

  const query = gql`
    {
      organization(login: "apollographql") {
        repositories(first: 5) {
          nodes {
            id
            name
            url
            viewerHasStarred
            stargazers {
              totalCount
            }
          }
        }
      }
    }
  `;

  const LOGIN = gql`
    mutation($email: String!, $password: String!) {
      Login(
        email: $email
        password: $password
      ) {
        access_token
        token_type
        expires_in
      }
    }
  `;


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
      ],
      organization:  {}
    }),
    methods: {
      login(e){       
        let self = this; 
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
          console.log(data);
        })

      }
    },
    apollo: {
      organization: {
        query: query,
        loadingKey: 'loading'
      },
    }
  }
</script>

<style>

</style>
