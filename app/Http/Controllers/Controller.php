<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Retrieve the user who invoked the request
     * If the user is a guest null will be returned
     *
     * @return User|null
     */
    protected function user()
    {
        return app('request')->user();
    }
}
