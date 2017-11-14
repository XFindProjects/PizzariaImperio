<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados, copia é crime!
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 14/11/2017
 * Hora: 10:47:36
 */

namespace App\Support\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'slug' => $data['name']
        ]);
    }


    /**
     * @param User|string $user
     * @param $data
     * @return User|bool
     */
    public function update($user, array $data)
    {
        $payload = collect($data)
            ->filter(function ($value, $field) use ($user) {
                return $field != 'password' &&
                    $user[$field] != $value;
            });

        foreach(['name', 'role'] as $field) {
            if ($payload->has($field)) {
                $user[$field] = $payload[$field];
            }
        }

        if (collect($data)->has('password')) {
            if (!Hash::check($data['password'], $user->password)) {
                $user['password'] = bcrypt($data['password']);
            }
        }

        $user->save();

        return $user;
    }

    public function findBySlug($slug)
    {
        return User::where('slug', $slug)->first();
    }
}