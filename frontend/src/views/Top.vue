<template>
  <v-form v-model="valid">
    <v-container>
      <v-layout row wrap>
        <v-flex xs12>
          <v-subheader>
            Tweet
          </v-subheader>
        </v-flex>
        <v-flex mb-2>
          <v-sheet class="pa-4" elevation=6>
              <v-avatar color="grey lighten-4">
                <img src="https://avatars1.githubusercontent.com/u/1452819?s=460&v=4" />
              </v-avatar>
            <router-link to="/profile">
              <v-btn>
                profile
              </v-btn>
            </router-link>
            <v-text-field
              v-model="tweet"
              :rules="tweetRules"
              label="tweet"
              required
            ></v-text-field>
            <v-btn color="primary" @click="postTweet">ツイート</v-btn>
          </v-sheet>
        </v-flex>
        <v-flex xs12>
          <v-sheet class="pa-4" elevation=6>
            <Timeline v-bind:timelines="timelines" v-on:markFavorite="markFavorite" />
          </v-sheet>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { TIMELINE } from "../graphql/query.js";
  import { CREATE_TWEET } from "../graphql/mutation.js";
  import Timeline from "../components/Timeline.vue";

  export default {
    components: {Timeline},
    data: () => ({
      valid: false,
      timelines: [],
      tweet: "",
      tweetRules: [
        v => !!v || 'required'
      ],
    }),
    methods: {
      postTweet(e){
        this.$apollo.mutate({
          mutation: CREATE_TWEET,
          variables: {
            tweet: this.tweet,
          }
        }).then((data) => {
          this.$apollo.queries.timelines.refetch({
            id: 0
          });
        });
      },
      markFavorite(){
        this.$apollo.queries.timelines.refetch({
            id: 0
        });
      }
    },
    apollo: {
      timelines: {  // query2: variablesを入れて、返却データを変更するパターン
        query: TIMELINE,
        loadingKey: 'loading',
        // Parameters
        variables () {
          return {
            id: 0
          }
        },
        update (data) {
          return data.Timeline.reverse();
        },
      }
    }
}
</script>

<style>

</style>
