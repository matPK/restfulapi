<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'is_verified' => (int)$user->verified,
            'is_admin' => ($user->admin === User::ADMIN_USER),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'deleted_at' => !is_null($user->deleted_at) ? (string) $user->deleted_at : null,
        ];
    }
}
