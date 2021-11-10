<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Retrieve user data
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index()
    {
        return response($this->user());
    }
}
