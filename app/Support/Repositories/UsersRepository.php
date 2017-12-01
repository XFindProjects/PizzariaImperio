<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:9:47
 */

namespace Pizzaria\Support\Repositories;

use Pizzaria\User;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    public $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->userModel->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role']
        ]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function findBySlug($slug)
    {
        return $this->userModel->where('slug', $slug)->first();
    }

    public function getUsers($columns = ['*'], $paginate = true, $perPageOrTake = 20, $orderColumn = 'name', $orderDirection = 'asc')
    {
        $query = $this->userModel->orderBy($orderColumn, $orderDirection);

        if ($paginate) {
            return $query->paginate($perPageOrTake);
        } elseif ($perPageOrTake) {
            return $query->take($perPageOrTake);
        }

        return $query->get($columns);
    }

    /**
     * @param User|string $user
     * @param $data
     * @return User|bool
     */
    public function update($user, array $data)
    {
        $payload = collect($data)
            ->except(['email'])
            ->filter(function ($value, $field) use ($user) {
                return $field != 'password' &&
                    $user->$field != $value;
            });

        if (collect($data)->has('password')) {
            if (!Hash::check($data['password'], $user->password)) {
                $payload->put('password', bcrypt($data['password']));
            }
        }

        $user->update($payload->toArray());

        return $user;
    }


    /**
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        return $user->delete();
    }
}