@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @php dd($adminLogin) @endphp --}}
    @livewire('message', ['users' => $users, 'usersLogin' => $usersLogin, 'adminLogin' => $adminLogin, 'messages' => $messages ?? null])
</div>
@endsection
