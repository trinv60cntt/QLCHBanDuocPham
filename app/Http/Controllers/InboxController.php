<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\NguoiDung;
use App\Models\KhachHang;
use \App\Models\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    public function __construct(
        NguoiDung $nguoidung
    ) {
        $this->nguoidung = $nguoidung;
    }
    public function index() {
        // Show just the users and not the admins as well
        $users = NguoiDung::where('is_admin', false)->orderBy('id', 'DESC')->get();
        $usersLogin = NguoiDung::get();
        $adminLogin = NguoiDung::get();
        $khachhangs = Session::get('email');
        // dd($khachhangs);
        if(!Session::get('khachhang_id') && $khachhangs == null) {
            if((Auth::user() == null)) {
                return redirect('login-checkout')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng tư vấn trực tuyến');
            }
        } 
        else {
        if($khachhangs != null) {
            // dd('vao');
            $temp = $usersLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($usersLogin[$i]['email'] == $khachhangs) {
                    $usersLogin = $usersLogin[$i];
                    break;
                }
            }

            if ($usersLogin->is_admin == false) {
                $messages = Message::where('user_id', $usersLogin->id)->orWhere('receiver', $usersLogin->id)->orderBy('id', 'DESC')->get();
            }
        }
        }
        // dd('xuong day');
        // foreach($users as $key => $user)
        // {
        //     foreach($khachhangs as $khachhang) {
        //         if($user->email == $khachhang->email) {
        //             $users = $user[$keys];
        //         }
        //     }
        // }
        // dd($usersLogin);
        // dd();
        // if(count($usersLogin) == 1) {
        //     // dd('hihi');
        //     if ($usersLogin->is_admin == false) {
        //         $messages = Message::where('user_id', $usersLogin->id)->orWhere('receiver', $usersLogin->id)->orderBy('id', 'DESC')->get();
        //     }
        // }
  

        // if ($khachhangs == true) {
        //     dd('hihi');
        //     $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        // }
        // dd($messages);
        // dd('hihi1');
        // if($khachhangs != null) {
        // }
        if((Auth::user() != null)) {
            $temp = $adminLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($adminLogin[$i]['email'] == Auth::user()->email) {
                    $adminLogin = $adminLogin[$i];
                    break;
                }
            }
        }
        // dd($adminLogin);
        return view('homenew', [
            'users' => $users,
            'usersLogin' => $usersLogin,
            'adminLogin' => $adminLogin,
            // 'khachhangs' => $khachhangs,
            'messages' => $messages ?? null
        ]);
    }

    public function show($id) {
        // dd('hihi');
        $usersLogin = NguoiDung::get();
        $adminLogin = NguoiDung::get();
        $khachhangs = Session::get('email');
        if($khachhangs != null) {
            $temp = $usersLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($usersLogin[$i]['email'] == $khachhangs) {
                    $usersLogin = $usersLogin[$i];
                    break;
                }
            }
            if ($usersLogin->is_admin == false) {
                // dd('hihi');
                abort(404);
            }
        }
        // $sender = [];
        // $nguoidung = $this->nguoidung->get();
        // foreach($nguoidung as $item) {
        //     if($item->id == $id) {
        //         $sender = $item;
        //     }
        // }
        $sender = NguoiDung::findOrFail($id);
        // dd($sender);

        $users = NguoiDung::with(['message' => function($query) {
            return $query->orderBy('created_at', 'DESC');
        }])->where('is_admin', false)
            ->orderBy('id', 'DESC')
            ->get();

        if($khachhangs != null) {
            $messages = Message::where('user_id', $usersLogin->id)->orWhere('receiver', $usersLogin->id)->orderBy('id', 'DESC')->get();
        }
        else {
            // dd('2');
            $messages = Message::where('user_id', $sender)->orWhere('receiver', $sender)->orderBy('id', 'DESC')->get();
            // $messages = Message::where('user_id', 4)->get();
            // dd($messages);
        }

        if((Auth::user() != null)) {
            $temp = $adminLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($adminLogin[$i]['email'] == Auth::user()->email) {
                    $adminLogin = $adminLogin[$i];
                    break;
                }
            }
        }
        // dd($adminLogin);
        return view('show', [
            'users' => $users,
            'usersLogin' => $usersLogin,
            'adminLogin' => $adminLogin,
            'messages' => $messages,
            'sender' => $sender,
        ]);
    }

}
