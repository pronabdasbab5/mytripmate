@extends('admin.layouts.app')

@section('content')
<form method="POST" action="{{ route('admin.login.post') }}" autocomplete="off">
                        @csrf
    <h1>Login</h1>
                @error('email')
                    <strong>Invalid Authentication</strong>
                @enderror
              <div>
                <input type="email" class="form-control form-text-element" placeholder="Enter Your Email" name="email" required autofocus/>
              </div>
              <div>
                <input id="password" type="password" class="form-control form-text-element" placeholder="Enter Your Password" name="password" required/>
              </div>
              <div>
                <button type="submit" class="btn btn-default submit form-text-element">{{ __('Login') }}</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                 <div>
                  <h1><i class="fa fa-paw"></i> My Trip Mate</h1>
                  <p>©2016 All Rights Reserved. Developed By WebInfotech</p>
                </div>
              </div>
            </form>
@endsection