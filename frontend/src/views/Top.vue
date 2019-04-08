<template>
  <v-form v-model="valid" @submit="postTweet">
    <v-container>
      <v-layout row wrap>
        <v-flex xs12>
          <v-subheader>
            Tweet
          </v-subheader>
        </v-flex>
        <v-flex mb-2>
          <v-sheet class="pa-4" elevation=6>
            <v-list-tile
              avatar
            >
              <v-list-tile-avatar>
                <img :src="'http://localhost:8000/storage/images/' + account.avatar" v-if="account.avatar"/>
                <v-icon v-else>account_circle</v-icon>
              </v-list-tile-avatar>

              <v-list-tile-content>
                <v-list-tile-sub-title v-html="account.twitter_id"></v-list-tile-sub-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-text-field
              v-model="tweet"
              :rules="tweetRules"
              label="tweet"
              required
            ></v-text-field>
            <v-btn type="submit" color="primary">ツイート</v-btn>
          </v-sheet>
        </v-flex>
        <v-flex xs12>
          <v-sheet class="pa-4" elevation=6>
            <Timeline v-bind:timelines="timelines" v-bind:account="account" v-on:markFavorite="markFavorite" />
          </v-sheet>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { TIMELINE, ACCOUNT } from "../graphql/query.js";
  import { CREATE_TWEET } from "../graphql/mutation.js";
  import Timeline from "../components/Timeline.vue";

  export default {
    components: {Timeline},
    data: () => ({
      valid: false,
      timelines: [],
      account: {},
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
          return data.Timeline;
        },
      },
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

<style>

</style>
