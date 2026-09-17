@if ($errors->any())
<div class="alert alert-danger" id="error-msg">
    <strong>{{ __('messages.Error') }} !</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success" >
    <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('success_img'))
<div class="alert alert-success" >
    <img src="https://www.clipartmax.com/png/middle/301-3011314_pe-success-icon-task-done.png" alt="">
    <p>{{ $message }}</p>
</div>
@endif
