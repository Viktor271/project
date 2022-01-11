<?php

namespace App\GraphQL\Mutations;

use App\Models\Business;
use App\Jobs\BusinessJob;

class UpdateBusiness
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        if (!empty($args['id'])) {
            $business = Business::find($args['id']);
            
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
                "method" => "UpdateBusiness",
                "entity" => $business,
            ];

            BusinessJob::dispatch(json_encode($result));

            return $business;

        }else{
            return 'Error: argument "ID" is empty';
        }
    }
}
