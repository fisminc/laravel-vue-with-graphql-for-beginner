<template>
  <v-form v-model="valid" @submit="login">
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
          <v-btn color="primary" type="submit">login</v-btn>
          <router-link to="/signup"><v-btn　flat>signup</v-btn></router-link>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { LOGIN } from "../graphql/mutation.js";
  import store from "../store/index";

  export default {
    data: () => ({
      valid: false,
      email: "",
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      pass: "",
      passRules: [
        v => !!v || "id is required",
        v => v.length <= 6 || "Name must be less than 6 characters"
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
          store.commit("logined");
          this.$router.push("/");
        });
      },
      pickFile () {
        this.$refs.image.click();
      },
      onFilePicked (e) {
        const files = e.target.files
        if(files[0] !== undefined) {
          this.imageName = files[0].name
          if(this.imageName.lastIndexOf(".") <= 0) {
            return
          }
          const fr = new FileReader ()
          fr.readAsDataURL(files[0])
          fr.addEventListener("load", () => {
            this.imageUrl = fr.result
            this.imageFile = files[0] 
          })
        } else {
          this.imageName = ""
          this.imageFile = ""
          this.imageUrl = ""
        }
      }
    }
  }
</script>
