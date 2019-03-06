import Vue from "vue";
import './plugins/vuetify';
import App from "./App.vue";
import router from "./router";

// apollo本体
import { ApolloClient } from 'apollo-client';
// ApolloClientへのオプション
import { setContext } from 'apollo-link-context';
import { createHttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';
// vueとの紐付け
import VueApollo from 'vue-apollo';
import Vuetify from "vuetify";

Vue.config.productionTip = false;

Vue.use(VueApollo);
Vue.use(Vuetify, {
  iconfont: "mdi" // 'md' || 'mdi' || 'fa' || 'fa4'
});

const httpLink = createHttpLink({
  uri: 'http://localhost:8000/graphql'
});

const authLink = setContext((_, { headers }) => {
  const token = localStorage.getItem('vue_token');
  return {
    headers: {
      ...headers,
      authorization: token ? `Bearer ${token}` : "",
    }
  }
});

const apolloClient = new ApolloClient({
  link: authLink.concat(httpLink),
  cache: new InMemoryCache(),
});

const apolloProvider = new VueApollo({
  defaultClient: apolloClient
});

new Vue({
  router,
  apolloProvider,
  render: h => h(App)
}).$mount("#app");
