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
            'is_verified' => ((int)$user->verified === 1),
            'is_admin' => ($user->admin === User::ADMIN_USER),
            'creation_date' => (string)$user->created_at,
            'last_change_date' => (string)$user->updated_at,
        ];
    }

    /**
     * Obtains the original attribute.
     * @param string $index [the transformed attribute name]
     * @return mixed
     */
    public static function originalAttribute($index)
    {
        $attributes = [
            'uid' => 'id',
            'name' => 'name',
            'email' => 'email',
            'is_verified' => 'verified',
            'is_admin' => 'admin',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
