import gql from 'graphql-tag';

export const TIMELINE = gql`
  query($id: Int!) {
    Timeline(id: $id) {
      id
      tweet {
        id
        content
        account {
          twitter_id
          avatar
        }
      }
      originalFavorite {
        account {
          twitter_id
          name
        }
      }
      favorite {
        favorite_at
      }
    }
  }
`;

export const ACCOUNT = gql`
  query{
    Account {
      twitter_id
      name
      avatar
    }
  }
`;

export const ACCOUNTS = gql`
  query($count: Int!,$page: Int!){
    Accounts(count: $count, page: $page) {
      data {
        id
        twitter_id
        avatar
        is_following_account
      }
    }
  }
`;