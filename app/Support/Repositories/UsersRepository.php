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
            'role' => $data['role']
        ]);
    }


    /**
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        return $user->delete();
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

        foreach (['name', 'role'] as $field) {
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

    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function findBySlug($slug)
    {
        return User::where('slug', $slug)->first();
    }

    public function getUsers($paginate = true, $perPageOrTake = 20, $orderColumn = 'name', $orderDirection = 'asc')
    {
        $query = User::orderBy($orderColumn, $orderDirection);

        if ($paginate) {
            return $query->paginate($perPageOrTake);
        } elseif ($perPageOrTake) {
            return $query->take($perPageOrTake);
        }

        return $query->get();
    }
}