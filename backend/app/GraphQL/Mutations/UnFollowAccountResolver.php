<?php

namespace App\GraphQL\Mutations;

use App\Models\Follow;
use App\Models\Follower;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UnFollowAccountResolver
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
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        /** @var \App\Models\Account $account */
        $account = auth()->user();

        if (!$this->unFollowAccount($account, $args)) { // ①
            return false;
        }

        if (!$this->removeFromFollowers($account, $args)) { // ②
            return false;
        }

        return true;
    }

    /**
     * @param \App\Models\Account $account
     * @param array $data
     * @return bool|null
     * @throws \Exception
     */
    protected function unFollowAccount(\App\Models\Account $account, array $data)
    {
        return Follow::where([
            'account_id'        => $account->id,
            'follow_account_id' => $data['id'],
        ])->delete();
    }

    /**
     * @param \App\Models\Account $account
     * @param array $data
     * @return bool|null
     * @throws \Exception
     */
    protected function removeFromFollowers(\App\Models\Account $account, array $data)
    {
        return Follower::where([
            'account_id'          => $data['id'],
            'follower_account_id' => $account->id,
        ])->delete();
    }
}