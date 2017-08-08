<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
	/**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function findAdmin()
    {
    	return User::find(1);
    }
}