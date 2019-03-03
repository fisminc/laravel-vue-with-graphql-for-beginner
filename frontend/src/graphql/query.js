import gql from 'graphql-tag';

export const TIMELINE = gql`
  query($id: Int!){
    Timeline(id: $id) {
      id
      tweet {
        id
        content
        myRetweet {
          tweet {
            id
            account_id
            content
          }
        }
      }
      favorite {
        favorite_at
      }
    }
  }
`;
