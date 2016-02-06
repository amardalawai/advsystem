@extends('pages.layout.guest')
@section('title', 'Register')
@section('title-info', 'Please fill in information for your account.')
@section('content')
@parent
<form method="POST" action="<?php echo url('auth/register') ?>">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="required" placeholder="User name">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}"  required="required" placeholder="Email address">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password"  required="required" placeholder="Password">
    </div>

    <div  class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation"  required="required" placeholder="Confirm Password">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="{{ url('/') }}" class="btn btn-success">Login</a>
    </div>
</form>
@stop
