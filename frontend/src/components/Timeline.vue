<template>
  <v-list two-line>
      <template v-for="(timeline, index) in timelines">
        <v-list-tile
          :key="index"
          avatar
        >
          <v-list-tile-avatar>
            <img src="https://avatars1.githubusercontent.com/u/1452819?s=460&v=4" />
          </v-list-tile-avatar>

          <v-list-tile-content>
            <div>{{timeline.tweet.content}}</div>

            <v-btn v-if="!timeline.favorite" :data-tweet-id="timeline.tweet.id" @click="markFavorite" flat icon color="blue-grey lighten-4">
              <v-icon>favorite</v-icon>
            </v-btn>
            <v-btn v-else :data-tweet-id="timeline.tweet.id" @click="unMarkFavorite" flat icon color="pink">
              <v-icon>favorite</v-icon>
            </v-btn>

          </v-list-tile-content>
        </v-list-tile>
        <v-divider v-if="index + 1 < timeline.length" :key="`divider-${index}`"></v-divider>
      </template>
    </v-list>
</template>

 
<script>
  import { MARK_FAVORITE } from "../graphql/mutation.js";
  import { UN_MARK_FAVORITE } from "../graphql/mutation.js";

  export default {
    props: {
      timelines: Array,
    },
    methods: {
      markFavorite(e){
        this.$apollo.mutate({
          mutation: MARK_FAVORITE,
          variables: {
            tweet_id: parseInt(e.currentTarget.getAttribute("data-tweet-id"), 10),
          },
        }).then((data) => {
          this.$emit("markFavorite")
        });
      },
      unMarkFavorite(){
        this.$apollo.mutate({
          mutation: UN_MARK_FAVORITE,
          variables: {
            tweet_id: parseInt(e.currentTarget.getAttribute("data-tweet-id"), 10),
          },
        }).then((data) => {
          this.$emit("markFavorite")
        });
      }
    },
    mounted(){
      console.log(this.timelines);
    }
  }
</script>