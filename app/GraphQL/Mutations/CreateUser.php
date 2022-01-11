<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

class CreateUser
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = new User();
        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->password = $args['password'];

        $user->save();

        return $user;
    }
}
