<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\KhachHang;
use \App\Models\User;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    use WithFileUploads;

    public $users;
    public $usersLogin;
    public $adminLogin;
    public $messages = '';
    public $sender;
    public $message;
    public $file;
    public $not_seen;

    public function render()
    {
        return view('livewire.show', [
            'users' => $this->users,
            'usersLogin' => $this->usersLogin,
            'adminLogin' => $this->adminLogin,
            'messages' => $this->messages,
            'sender' => $this->sender
        ]);
    }

    public function mountComponent() {
        $usersLogin = User::get();
        $adminLogin = NguoiDung::get();
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
            $this->messages = \App\Models\Message::where('user_id', $this->sender->id)
                                                    ->orWhere('receiver', $this->sender->id)
                                                    ->orderBy('id', 'DESC')
                                                    ->get();
        }
        $not_seen = [];
        if((Auth::user() != null)) {
            $temp = $adminLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($adminLogin[$i]['email'] == Auth::user()->email) {
                    $adminLogin = $adminLogin[$i];
                    break;
                }
            }
            $not_seen = \App\Models\Message::where('user_id', $this->sender->id)->where('receiver', $adminLogin->id);
        }
        // dd($not_seen);
        $not_seen->update(['is_seen' => true]);
    }

    public function mount()
    {
        return $this->mountComponent();
    }

    public function SendMessage() {
        $usersLogin = NguoiDung::get();
        $khachhangs = Session::get('email');
        $adminLogin = NguoiDung::get();
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
        if($khachhangs != null) {
            $temp = $usersLogin;
            for ($i = 0; $i < count($temp); $i++) {
                if($usersLogin[$i]['email'] == $khachhangs) {
                    $usersLogin = $usersLogin[$i];
                    break;
                }
            }

            $new_message = new \App\Models\Message();
            $new_message->message = $this->message;
            $new_message->user_id = $usersLogin->id;
            $new_message->receiver = $this->sender->id;
        }
        else {
            $new_message = new \App\Models\Message();
            $new_message->message = $this->message;
            $new_message->user_id = $adminLogin->id;
            $new_message->receiver = $this->sender->id;
        }


        // Deal with the file if uploaded
        if ($this->file) {
            $uploaded = $this->uploadFile();
            $new_message->file = $uploaded[0];
            $new_message->file_name = $uploaded[1];
        }
        
        $new_message->save();
        // Clear the message after it's sent
        $this->reset('message');
        $this->file = '';
    }

    public function resetFile() 
    {
        $this->reset('file');
    }

    public function uploadFile() {
        $file = $this->file->store('public/files');
        $path = url(Storage::url($file));
        $file_name = $this->file->getClientOriginalName();
        return [$path, $file_name];
    }

}
