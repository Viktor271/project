<?php

namespace App\GraphQL\Mutations;

use App\Models\Business;
use App\Jobs\BusinessJob;

class CreateBusiness
{
    /** 
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $business = new Business();

        if (isset($args['name'])) {
            $business->name = $args['name'];
        }

        if (isset($args['adress'])) {
            $business->adress = $args['adress'];
        }

        if (isset($args['chief_id'])) {
            $business->chief_id = $args['chief_id'];
        }

        if (isset($args['INN'])) {
            $business->INN = $args['INN'];
        }

        $business->save();

        $result = [
            "method" => "CreateBusiness",
            "entity" => $business,
        ];

        BusinessJob::dispatch(json_encode($result));

        return $business;
    }
}
