<template>
  <v-list two-line>
      <template v-for="(timeline, index) in timelines">
        <v-list-tile
          :key="index"
          avatar
        >
          <v-list-tile-avatar>
            <img :src="'http://localhost:8000/storage/images/' + timeline.tweet.account.avatar" v-if="timeline.tweet.account.avatar"/>
            <v-icon v-else>account_circle</v-icon>
          </v-list-tile-avatar>

          <v-list-tile-content>
            <div v-text="timeline.originalFavorite ? timeline.originalFavorite.account.name + 'さんがいいねしました' : ''"></div>
            <v-list-tile-sub-title v-html="timeline.tweet.account.twitter_id"></v-list-tile-sub-title>
            <v-list-tile-title v-html="timeline.tweet.content"></v-list-tile-title>
          </v-list-tile-content>

          <v-list-tile-action>
            <v-btn v-if="!timeline.favorite" @click="()=>markFavorite(timeline.tweet.id, timeline.id)" flat icon color="blue-grey lighten-4">
              <v-icon>favorite</v-icon>
            </v-btn>
            <v-btn v-else @click="()=>unMarkFavorite(timeline.tweet.id, timeline.id)" flat icon color="pink">
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
      markFavorite(tweetId, timelineId){
        this.$apollo.mutate({
          mutation: MARK_FAVORITE,
          variables: {
            tweet_id: parseInt(tweetId, 10),
            timeline_id: parseInt(timelineId, 10)
          },
        }).then((data) => {
          this.$emit("markFavorite")
        });
      },
      unMarkFavorite(tweetId, timelineId){
        this.$apollo.mutate({
          mutation: UN_MARK_FAVORITE,
          variables: {
            tweet_id: parseInt(tweetId, 10),
            timeline_id: parseInt(timelineId, 10)
          },
        }).then((data) => {
          this.$emit("markFavorite")
        });
      }
    }
  }
</script>