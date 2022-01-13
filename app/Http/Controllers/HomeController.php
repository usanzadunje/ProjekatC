<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request) {
        $userRole = $request->user()->role;

        return match ($userRole) {
            Role::ADMIN => redirect()->route('admin.dashboard'),
            Role::STAFF => redirect()->route('staff.dashboard'),
            Role::USER => redirect()->route('user.dashboard'),
            default => redirect()->route('welcome'),
        };
    }
}
