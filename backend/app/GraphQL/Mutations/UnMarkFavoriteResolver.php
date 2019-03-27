<?php

namespace App\GraphQL\Mutations;

use App\Models\Account;
use App\Models\Favorite;
use App\Models\Timeline;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UnMarkFavoriteResolver
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
     * @throws \Exception
     */
    public function resolve($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        /** @var \App\Models\Account $account */
        $account = auth()->user();

        $this->updateTimelineFavoriteId($account, $args['timeline_id']); // ①

        /** @var Favorite $favorite */
        return $this->deleteFavorite($account, $args['tweet_id']); // ②
    }

    /**
     * @param Account $account
     * @param $timelineId
     * @return bool
     */
    protected function updateTimelineFavoriteId(Account $account, $timelineId)
    {
        return Timeline::where([
            'id' => $timelineId,
            'account_id'  => $account->id,
        ])->update(['favorite_id' => null]);
    }

    /**
     * @param \App\Models\Account $account
     * @param $tweetId
     * @return bool|null
     * @throws \Exception
     */
    protected function deleteFavorite(Account $account, $tweetId)
    {
        return Favorite::where([
            'tweet_id'   => $tweetId,
            'account_id' => $account->id
        ])->delete();
    }
}
