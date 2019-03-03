<template>
  <v-form v-model="valid">
    <v-container>
      <v-layout row wrap>
        
      <v-flex xs12 mb-2>
        <v-sheet class="pa-4" elevation=6>
          <v-text-field
            v-model="tweet"
            label="tweet"
            required
          ></v-text-field>
          <v-btn color="primary" @click="postTweet">ツイート</v-btn>
        </v-sheet>
      </v-flex>
      <v-flex xs12>
        <v-sheet class="pa-4" elevation=6>
          tweet
          <v-list two-line>
              <template v-for="(timeline, index) in timelines">
                <v-list-tile
                  :key="index"
                  avatar
                  @click=""
                >
                  <v-list-tile-avatar>
                    <img src="https://avatars1.githubusercontent.com/u/1452819?s=460&v=4" />
                  </v-list-tile-avatar>

                  <v-list-tile-content>
                    <div>{{timeline.tweet.content}}</div>
                  </v-list-tile-content>
                </v-list-tile>
                <v-divider v-if="index + 1 < timeline.length" :key="`divider-${index}`"></v-divider>
              </template>
            </v-list>
        </v-sheet>
      </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { TIMELINE } from "../graphql/query.js";
  import { CREATE_TWEET } from "../graphql/mutation.js";

  export default {
    data: () => ({
      valid: false,
      timelines: [],
      tweet: ""
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
          })
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
          return data.Timeline
        },
      }
    }
}
</script>

<style>

</style>
