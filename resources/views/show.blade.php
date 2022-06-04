@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            {{-- @php dd($adminLogin); @endphp --}}
            @livewire('show', ['users' => $users, 'usersLogin' => $usersLogin, 'adminLogin' => $adminLogin, 'messages' => $messages, 'sender' => $sender])
        </div>
    </div>
@endsection
