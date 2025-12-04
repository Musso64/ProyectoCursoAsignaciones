<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('search') and $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if ($request->has('role') and $request->role != '') {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(10);
        return view('user.index', [
            'usuarios' => $users
        ]);
    }
}
