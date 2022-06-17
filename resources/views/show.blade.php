<?php
$khachhangs = Session::get('email');
?>

@extends((($khachhangs != null) ? 'layouts.clients' : 'layouts.admin' ))
@section('content')
    <div class="container-fluid">
        <div class="container max-w-6xl mx-auto my-14">
            {{-- @php dd($adminLogin); @endphp --}}
            @livewire('show', ['users' => $users, 'usersLogin' => $usersLogin, 'adminLogin' => $adminLogin, 'messages' => $messages, 'sender' => $sender])
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    $(document).ready(function(){
        const heightCardV1 = $('.card-v1').height();
        const heightCardV2 = $('.card-v2').height();
        $('.card-v1').css("height", heightCardV2 + "px");
    });

    $(document).on('scroll', () => {
        $('.nav-home-page').removeClass('fixed')
        $('.header-bottom').css('margin-top', 0);
    })
</script>
@endsection