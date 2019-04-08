<?php

namespace App\GraphQL\Queries;

use App\Models\Timeline;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TimelineResolver
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
        $query = Timeline
            ::with([
                'tweet',
            ])
            ->where('account_id', auth()->user()->id);

        if ($args['id']) {
            $query->where('id', '<', $args['id']); // ①
        }

        $timelines = $query->orderByDesc('id')
                           ->limit(10) // ②
                           ->get();

        return $timelines;
    }
}