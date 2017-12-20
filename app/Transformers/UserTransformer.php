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
            'isVerified' => (int)$user->verified,
            'isAdmin' => ($user->admin === User::ADMIN_USER),
            'creationDate' => $user->created_at,
            'lastChange' => $user->updated_at,
            'deletedDate' => !is_null($user->deleted_at) ? (string) $user->deleted_at : null,
        ];
    }
}
