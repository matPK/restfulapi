<?php

namespace App\Transformers;

use App\Admin;
use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param Admin $admin [A admin instance]
     * @return array
     */
    public function transform(Admin $admin)
    {
        return [
            'uid' => (int)$admin->id,
            'name' => (string)$admin->name,
            'email' => (string)$admin->email,
            'isVerified' => ((int)$admin->verified === 1),
            'isAdmin' => ($admin->admin === User::ADMIN_USER),
            'creationDate' => $admin->created_at,
            'lastChangeDate' => $admin->updated_at,
            'deletedDate' => isset($admin->deleted_at)?(string)$admin->deleted_at:null,
        ];
    }
}
