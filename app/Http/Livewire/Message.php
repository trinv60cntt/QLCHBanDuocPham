<?php

namespace App\Http\Livewire;

use \App\Models\NguoiDung;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Session;


class Message extends Component
{
    use WithFileUploads;

    public $message = '';
    public $users;
    public $usersLogin;
    public $adminLogin;
    public $clicked_user;
    public $messages;
    public $file;
    public $admin;

    public function render()
    {

        return view('livewire.message', [
            'users' => $this->users,
            'usersLogin' => $this->usersLogin,
            'adminLogin' => $this->adminLogin,
            'admin' => $this->admin
        ]);
    }

    public function mount()
    {
        $this->mountComponent();
    }

    public function mountComponent() {
        // dd("hihi");
        $users = NguoiDung::where('is_admin', false)->orderBy('id', 'DESC')->get();
        $usersLogin = NguoiDung::get();
        // dd("hihi");
        $khachhangs = Session::get('email');
        $temp = $usersLogin;
        for ($i = 0; $i < count($temp); $i++) {
            if($usersLogin[$i]['email'] == $khachhangs) {
                $usersLogin = $usersLogin[$i];
                break;
            }
        }
        if($khachhangs != null) {
            $this->messages = \App\Models\Message::where('user_id', $usersLogin->id)
            ->orWhere('receiver', $usersLogin->id)
            ->orderBy('id', 'DESC')
            ->get();
        }
        else {
            $this->messages = \App\Models\Message::where('user_id', $this->clicked_user)
                                                    ->orWhere('receiver', $this->clicked_user)
                                                    ->orderBy('id', 'DESC')
                                                    ->get();
        }
        // dd("hihi");
        $this->admin = \App\Models\NguoiDung::where('is_admin', true)->first();
        // dd($this->admin);
    }

    public function SendMessage() {
        $usersLogin = NguoiDung::get();
        $khachhangs = Session::get('email');
        $temp = $usersLogin;
        for ($i = 0; $i < count($temp); $i++) {
            if($usersLogin[$i]['email'] == $khachhangs) {
                $usersLogin = $usersLogin[$i];
                break;
            }
        }
        $new_message = new \App\Models\Message();
        $new_message->message = $this->message;
        // dd($usersLogin->id);
        $new_message->user_id = $usersLogin->id;
        if ($usersLogin->is_admin == false) {
            $admin = NguoiDung::where('is_admin', true)->first();
            $this->user_id = $admin->id;
        } else {
            $this->user_id = $this->clicked_user->id;
        }
        $new_message->receiver = $this->user_id;

        // Deal with the file if uploaded
        if ($this->file) {
            $file = $this->file->store('public/files');
            $path = url(Storage::url($file));
            $new_message->file = $path;
            $new_message->file_name = $this->file->getClientOriginalName();
        }
        $new_message->save();

        // Clear the message after it's sent
        $this->reset(['message']);
        $this->file = '';
    }

    public function getUser($user_id) 
    {
        $this->clicked_user = NguoiDung::find($user_id);
        $this->messages = \App\Models\Message::where('user_id', $user_id)->get();
    }

    public function resetFile() 
    {
        $this->reset('file');
    }

}
