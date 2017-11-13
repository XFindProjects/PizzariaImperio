<?php

namespace Acl\Http\Controllers;

class ReadUsersController extends Controller
{
    public function index()
    {
        return view('Acl::read');
    }
}