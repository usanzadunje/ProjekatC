<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request) {
        $userRole = $request->user()->role;

        return match ($userRole) {
            Role::ADMIN => redirect()->route('dashboard.admin'),
            Role::STAFF => redirect()->route('dashboard.staff'),
            Role::USER => redirect()->route('dashboard.user'),
            default => redirect()->route('welcome'),
        };
    }
}
