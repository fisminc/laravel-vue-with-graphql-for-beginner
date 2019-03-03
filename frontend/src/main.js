import Vue from "vue";
import './plugins/vuetify'
import App from "./App.vue";
import router from "./router";

import { setContext } from 'apollo-link-context';
import { ApolloClient } from 'apollo-client';
import { createHttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';
import VueApollo from 'vue-apollo';

Vue.config.productionTip = false;

Vue.use(VueApollo);

const httpLink = createHttpLink({
  uri: 'http://localhost:8000/graphql',
  credentials: 'include'
});

const authLink = setContext((_, { headers }) => {
  // get the authentication token from local storage if it exists
  const token = localStorage.getItem('token');
  // return the headers to the context so httpLink can read them
  return {
    headers: {
      ...headers,
      authorization: token ? `Bearer ${token}` : "",
    }
  }
});

// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvZ3JhcGhxbCIsImlhdCI6MTU1MTU5MzYyNywiZXhwIjoxNTUxNTk3MjI3LCJuYmYiOjE1NTE1OTM2MjcsImp0aSI6ImV6UThaT1dDdk1mZXE0NVUiLCJzdWIiOjEsInBydiI6ImM4ZWUxZmM4OWU3NzVlYzRjNzM4NjY3ZTViZTE3YTU5MGI2ZDQwZmMifQ.YNMXFcRMfWQZvJvfWzAQFlrkm9kGmXmTgTJFz6a8diU

// Create the apollo client
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
