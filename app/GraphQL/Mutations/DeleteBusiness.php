<?php

namespace App\GraphQL\Mutations;

use App\Models\Business;
use App\Jobs\BusinessJob;

class DeleteBusiness
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $business = Business::find($args['id']);
        $status = $business->delete();

        $result = [
            "method" => "DeleteBusiness",
            "status" => $status,
            "entity_id" => $args['id'],
        ];

        BusinessJob::dispatch(json_encode($result));

        return [
            'status' => $status,
            'message' => "Business deleted",
        ];
    }
}
