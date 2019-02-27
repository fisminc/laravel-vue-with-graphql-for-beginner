<?php

namespace App\Http\GraphQL\Mutations;

use App\Models\Account;
use App\Models\Follow;
use App\Models\Follower;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class FollowAccountResolver
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
    public function resolve($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        /** @var \App\Models\Account $account */
        $account = auth()->user();

        $follow = $this->followAccount($account, $args);

        $this->AddToFollowers($account, $args);

        return $follow;
    }

    /**
     * @param \App\Models\Account $account
     * @param array $data
     * @return \App\Models\Follow
     */
    protected function followAccount(Account $account, array $data)
    {
        return Follow::create([
            'account_id'        => $account->id,
            'follow_account_id' => $data['id'],
        ]);
    }

    /**
     * @param \App\Models\Account $account
     * @param array $data
     * @return \App\Models\Follower
     */
    protected function AddToFollowers(Account $account, array $data)
    {
        return Follower::create([
            'account_id' => $data['id'],
            'follower_account_id' => $account->id,
        ]);
    }
}
