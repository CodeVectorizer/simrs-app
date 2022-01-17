<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){            
            $users = User::orderBy('name','desc')
                ->get(['id', 'name', 'email']);
    
            return Inertia::render('Landing/Index', [
                'users' => $users
            ]);
            
        // return Inertia::render('Landing/Index',["test" => "test"]);
    }
}
