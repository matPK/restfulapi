<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param User $user [A user instance]
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'uid' => (int)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'isVerified' => ((int)$user->verified === 1),
            'isAdmin' => ($user->admin === User::ADMIN_USER),
            'creationDate' => $user->created_at,
            'lastChangeDate' => $user->updated_at,
            'deletedDate' => isset($user->deleted_at)?(string)$user->deleted_at:null,
        ];
    }
}
