@if(Session::has('error'))
  <p class="alert-error">{{ Session::get('error') }}</p>
@endif