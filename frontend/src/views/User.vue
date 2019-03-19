<template>
  <v-form v-model="valid">
    <v-container>
      <v-layout row wrap>
        <v-flex xs12>
          <v-sheet class="pa-4" elevation=6>
            <!-- <Timeline v-bind:timelines="timelines" v-bind:account="account" v-on:markFavorite="markFavorite" /> -->
            <template v-for="(account, index) in accounts">
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
                </v-list-tile-content>

                <v-list-tile-action>
                  <v-btn v-if="!account.is_following_account" :data-account-id="account.id" @click="followAccount" color="primary">
                    フォローする
                  </v-btn>
                  <v-btn v-else :data-account-id="account.id" @click="unFollowAccount" color="primary">
                    アンフォローする
                  </v-btn>
                </v-list-tile-action>
              </v-list-tile>
              <v-divider
                :key="index+'_divider'"
              ></v-divider>
            </template>
          </v-sheet>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import { ACCOUNTS } from "../graphql/query.js";
  import { FOLLOW_ACCOUNT, UN_FOLLOW_ACCOUNT } from "../graphql/mutation.js";
  import Timeline from "../components/Timeline.vue";

  export default {
    components: {Timeline},
    data: () => ({
      accounts: {},
    }),
    methods: {
      followAccount(e){
        this.$apollo.mutate({
          mutation: FOLLOW_ACCOUNT,
          variables: {
            id: parseInt(e.currentTarget.getAttribute("data-account-id"), 10)
          },
        }).then((data) => {
          this.$apollo.queries.accounts.refetch({
            count: 10,
            page: 1
          });
          // this.$emit("markFavorite")
        });
      },
      unFollowAccount(e){
        this.$apollo.mutate({
          mutation: UN_FOLLOW_ACCOUNT,
          variables: {
            id: parseInt(e.currentTarget.getAttribute("data-account-id"), 10)
          },
        }).then((data) => {
          this.$apollo.queries.accounts.refetch({
            count: 10,
            page: 1
          });
          // this.$emit("markFavorite")
        });
      }
    },
    apollo: {
      accounts: {
        query: ACCOUNTS,
        loadingKey: 'loading',
        variables () {
          return {
            count: 10,
            page: 1,
          }
        },
        update (data) {
          return data.Accounts.data
        },
      }
    }
}
</script>

