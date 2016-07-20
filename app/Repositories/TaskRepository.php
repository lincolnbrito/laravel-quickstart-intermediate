<?php
namespace App\Repositories;

use App\User;

class TaskRepository
{

    /**
     * Return all of the tasks for a given user
     * @param User $user
     * @return mixed
     */
    public function forUser(User $user)
    {
        return $user->tasks()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}