<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

class UpdateUser
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::find($args['id']);
        
        if (isset($args['name'])) {
            $user->name = $args['name'];
        }

        if (isset($args['email'])) {
            $user->email = $args['email'];
        }

        if (isset($args['password'])) {
            $user->password = $args['password'];
        }

        $user->save();

        return $user;
    }
}
