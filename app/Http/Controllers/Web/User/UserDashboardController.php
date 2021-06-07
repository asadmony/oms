<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function selectUser(Request $request)
    {
        $q = $request->q;
        $users = User::where(function ($query) use ($q) {
            $query->where('email', 'like', '%' . $q . '%');
            $query->orWhere('mobile', 'like', '%' . $q . '%');
        })
            ->where('active', true)

            ->select(['id', 'email', 'mobile'])->take(30)->get();
        if ($users->count()) {
            if ($request->ajax()) {
                return $users;
            }
        }
    }
}
