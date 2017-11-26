<?php

namespace Acl\Http\Controllers;

use Pizzaria\Http\Controllers\Controller as BaseController;
use Pizzaria\Support\Repositories\UsersRepository;

class Controller extends BaseController
{
    protected $userRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->userRepository = $usersRepository;
    }
}