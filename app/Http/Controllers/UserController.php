<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $country = 'Canada';

        return User::with(['companies' => function($query) use($country)
                {
                    $query->whereHas('country', function($query) use ($country)  {
                        $query->where('name', $country);
                    });
                }
            ])->get();
    }
}
