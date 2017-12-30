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
            'admin_id' => (int)$admin->id,
            'name' => (string)$admin->name,
            'email' => (string)$admin->email,
            'creationDate' => (string)$admin->created_at,
            'lastChangeDate' => (string)$admin->updated_at,
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
            'admin_id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'creation_date' => 'created_at',
            'last_change_date' => 'updated_at',
        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
