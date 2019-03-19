<template>
  <v-list two-line>
      <template v-for="(timeline, index) in timelines">
        <v-list-tile
          :key="index"
          avatar
        >
          <v-list-tile-avatar>
            <img :src="'http://localhost:8000/storage/images/' + account.avatar" v-if="account.avatar"/>
            <v-icon v-else>account_circle</v-icon>
          </v-list-tile-avatar>

          <v-list-tile-content>
            <v-list-tile-sub-title v-html="account.twitter_id"></v-list-tile-sub-title>
            <v-list-tile-title v-html="timeline.tweet.content"></v-list-tile-title>
          </v-list-tile-content>

          <v-list-tile-action>
            <v-btn v-if="!timeline.favorite" :data-tweet-id="timeline.tweet.id" :data-timeline-id="timeline.id" @click="markFavorite" flat icon color="blue-grey lighten-4">
              <v-icon>favorite</v-icon>
            </v-btn>
            <v-btn v-else :data-tweet-id="timeline.tweet.id" :data-timeline-id="timeline.id" @click="unMarkFavorite" flat icon color="pink">
              <v-icon>favorite</v-icon>
            </v-btn>
          </v-list-tile-action>
        </v-list-tile>
        <v-divider
          :key="index+'_divider'"
        ></v-divider>
      </template>
    </v-list>
</template>

 
<script>
  import { MARK_FAVORITE } from "../graphql/mutation.js";
  import { UN_MARK_FAVORITE } from "../graphql/mutation.js";

  export default {
    props: {
      timelines: Array,
      account: {
        avatar: null,
        name: "",
        twitter_id: ""
      }
    },
    methods: {
      markFavorite(e){
        this.$apollo.mutate({
          mutation: MARK_FAVORITE,
          variables: {
            tweet_id: parseInt(e.currentTarget.getAttribute("data-tweet-id"), 10),
            timeline_id: parseInt(e.currentTarget.getAttribute("data-timeline-id"), 10)
          },
        }).then((data) => {
          this.$emit("markFavorite")
        });
      },
      unMarkFavorite(e){
        this.$apollo.mutate({
          mutation: UN_MARK_FAVORITE,
          variables: {
            tweet_id: parseInt(e.currentTarget.getAttribute("data-tweet-id"), 10),
            timeline_id: parseInt(e.currentTarget.getAttribute("data-timeline-id"), 10)
          },
        }).then((data) => {
          this.$emit("markFavorite")
        });
      }
    }
  }
</script>