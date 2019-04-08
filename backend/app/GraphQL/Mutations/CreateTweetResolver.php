<?php

namespace App\GraphQL\Mutations;

use App\Models\Account;
use App\Models\Timeline;
use App\Models\Tweet;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateTweetResolver
{

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        /** @var \App\Models\Account $account */
        $account = auth()->user();

        $tweet = $this->createTweet($account, $args); // ①

        $this->addTweetToTimeline($account, $tweet); // ②

        $this->addTweetToFollowersTimeline($account, $tweet);

        return $tweet;
    }

    /**
     * @param \App\Models\Account $account
     * @param array $data
     * @return \App\Models\Tweet
     */
    protected function createTweet(Account $account, array $data)
    {
        return Tweet::create([
            'account_id' => $account->id,
            'content'    => $data['content'],
            'tweeted_at' => Carbon::now(),
        ]);

    }

    /**
     * @param \App\Models\Account $account
     * @param \App\Models\Tweet $tweet
     * @return \App\Models\Timeline
     */
    protected function addTweetToTimeline(Account $account, Tweet $tweet)
    {
        return Timeline::create([
            'account_id' => $account->id,
            'tweet_id'   => $tweet->id,
        ]);
    }

    /**
     * @param \App\Models\Account $account
     * @param \App\Models\Tweet $tweet
     */
    protected function addTweetToFollowersTimeline(Account $account, Tweet $tweet)
    {
        foreach ($account->followers as $follower) {
            Timeline::create([
                'account_id' => $follower->follower_account_id,
                'tweet_id'   => $tweet->id,
            ]);
        }
    }

}