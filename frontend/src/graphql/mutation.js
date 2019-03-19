import gql from 'graphql-tag';

// ログイン
export const LOGIN = gql`
  mutation($email: String! $password: String!) {
    Login(
      email: $email
      password: $password
    ) {
      access_token
      expires_in
    }
  }
`;

export const CREATE_TWEET = gql`
  mutation($tweet: String!) {
    CreateTweet(content: $tweet) {
      id
      content
      tweeted_at
    }
  }
`;

export const CREATE_ACCOUNT = gql`
  mutation(
    $name: String!
    $twitter_id: String!
    $email: String!
    $password: String!
    $password_confirmation: String!
  ) {
    CreateAccount(
      name: $name
      twitter_id: $twitter_id
      email: $email
      password: $password
      password_confirmation: $password_confirmation
    ) {
      account {
        twitter_id
      }
      token {
        access_token
        token_type
        expires_in
      }
    }
  }
`;

export const MARK_FAVORITE = gql`
  mutation($tweet_id: Int! $timeline_id: Int!) {
    MarkFavorite(tweet_id: $tweet_id timeline_id: $timeline_id)
  }
`;

export const UN_MARK_FAVORITE = gql`
  mutation($tweet_id: Int! $timeline_id: Int!) {
    UnMarkFavorite(tweet_id: $tweet_id timeline_id: $timeline_id)
  }
`;

export const UPDATE_PROFILE = gql`
  mutation($name: String! $avatar: String) {
    UpdateProfile(name: $name avatar: $avatar) {
      id
      twitter_id
      name
      email
      avatar
    }
  }
`;

export const FOLLOW_ACCOUNT = gql`
  mutation($id: Int!) {
    FollowAccount(id: $id) {
      id
      account_id
      follow_account_id
    }
  }
`;

export const UN_FOLLOW_ACCOUNT = gql`
  mutation($id: Int!) {
    UnFollowAccount(id: $id)
  }
`;