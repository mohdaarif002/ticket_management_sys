<?php namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
	public function createAuthority($arr){

        return User::create($arr);
        
	}


}