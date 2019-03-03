import gql from 'graphql-tag';

// ログイン
export const LOGIN = gql`
  mutation($email: String!, $password: String!) {
    Login(
      email: $email
      password: $password
    ) {
      access_token
      expires_in
    }
  }
`;

// ツイート
export const CREATE_TWEET = gql`
  mutation($tweet: String!) {
    CreateTweet(content: $tweet) {
      id
      content
      tweeted_at
    }
  }
`;