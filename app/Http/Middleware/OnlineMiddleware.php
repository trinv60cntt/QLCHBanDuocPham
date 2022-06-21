<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class OnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $adminLogin = NguoiDung::get();
        if((Auth::user() != null)) {
             $temp = $adminLogin;
             for ($i = 0; $i < count($temp); $i++) {
                 if($adminLogin[$i]['email'] == Auth::user()->email) {
                     $adminLogin = $adminLogin[$i];
                 }
             }
        }


        $usersLogin = NguoiDung::get();
        $khachhangs = Session::get('email');
        if($khachhangs != null) {
            // dd('vao');
            $temp = $usersLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($usersLogin[$i]['email'] == $khachhangs) {
                    $usersLogin = $usersLogin[$i];
                }
            }
        }
        $users_to_offline = NguoiDung::where('last_activity', '<', now());
        $users_to_online = NguoiDung::where('last_activity', '>=', now());
        // dd($users_to_online);
        if (isset($users_to_offline)) {
            $users_to_offline->update(['is_online' => false]);
        }if (isset($users_to_online)) {
            // dd('true');
            $users_to_online->update(['is_online' => true]);
        }
        // dd(filled(Cache::get('user-is-online')));
        if((Auth::user() != null)) {
            // dd($adminLogin);
            if ($adminLogin) {
                $cache_value = Cache::put('user-is-online', $adminLogin->id, \Carbon\Carbon::now()->addMinutes(1));
                $user = NguoiDung::find(Cache::get('user-is-online'));
                $user->last_activity = now()->addMinutes(1);
                $user->is_online = true;
                $user->save();
            }
        }
        // else {
        //     $user = NguoiDung::find(Cache::get('user-is-online'));
        //     // dd($user);
        //     if (isset($user)) {
        //         $user->is_online = false;
        //         $user->save();
        //     }
        // }
        if($khachhangs != null) {
            // dd('hihi');
            $cache_value = Cache::put('user-is-online', $usersLogin->id, \Carbon\Carbon::now()->addMinutes(1));
            $user = NguoiDung::find(Cache::get('user-is-online'));
            $user->last_activity = now()->addMinutes(1);
            $user->is_online = true;
            $user->save();
        } else if($khachhangs == null && Auth::user() == null) {
            // dd('hihi2');
            $user = NguoiDung::find(Cache::get('user-is-online'));
            if (isset($user)) {
                $user->is_online = false;
                $user->save();
            }
        }
        return $next($request);
    }
}
