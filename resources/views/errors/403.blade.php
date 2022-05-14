@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
<section>
  <div class="container px-6 mx-auto py-4">
    @if(Session::has('error'))
      <p class="alert-error">{{ Session::get('error') }}</p>
    @endif
    <div class="alert-403">Bạn không có quyền truy cập vào chức năng này</div>
  </div>
</section>
@endsection
