@extends('layout.login_layout')
@section('content')
<div class="contaier">
    <form method="POST" action="{{ route('login')}}">
        @csrf
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" id="inputEmail" class="form-control" placeholder="Email" name="email">
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-6">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="col-sm-2"></div>
        </div>

    </form>
</div>
@endsection