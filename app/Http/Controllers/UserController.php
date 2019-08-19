<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function profile(Request $request, string $id)
    {
        return $request->json(['test' => 'test']);
    }
}
