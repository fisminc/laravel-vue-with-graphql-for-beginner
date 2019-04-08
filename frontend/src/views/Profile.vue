<template>
  <v-form v-model="valid" @submit="updateProfile">
    <v-container grid-list-md>
      <v-layout row wrap>
        <v-flex xs12>
          <v-subheader>
            Profile
          </v-subheader>
        </v-flex>
        <v-flex xs12>
          <v-sheet class="pa-4" elevation=6>
              <v-text-field
                v-model="account.name"
                label="name"
                required
              ></v-text-field>
              <v-text-field
                v-model="account.twitter_id"
                label="twitter_id"
                disabled=true
              ></v-text-field>
              <v-flex>
                <img :src="'http://localhost:8000/storage/images/' + account.avatar" height="150" v-if="account.avatar"/>
                <img :src="imageUrl" height="150" v-else-if="imageUrl"/>
                <v-text-field label="Select Image" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
                <input
                  type="file"
                  style="display: none"
                  ref="image"
                  accept="image/*"
                  @change="onFilePicked"
                >
              </v-flex>
              <v-btn color="primary" type="submit">プロフィールアップデート</v-btn>
          </v-sheet>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>


<script>
  import { ACCOUNT } from "../graphql/query.js";
  import { UPDATE_PROFILE } from "../graphql/mutation.js";
  import store from "../store/index";

  export default {
    data: () => ({
      account: {},
      imageName: "",
      imageUrl: ""
    }),
    methods: {
      updateProfile (){
        this.$apollo.mutate({
          mutation: UPDATE_PROFILE,
          variables: {
            name: this.account.name,
            avatar: this.imageUrl ? this.imageUrl : ""
          }
        }).then((data) => {
          this.$apollo.queries.account.refetch();
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
            this.imageUrl = fr.result;
          })
        } else {
          this.imageName = "";
          this.imageUrl = "";
        }
      }
    },
    apollo: {
      account: {  // query2: variablesを入れて、返却データを変更するパターン
        query: ACCOUNT,
        loadingKey: 'loading',
        update (data) {
          return data.Account
        },
      }
    }
  }
</script>
