@extends('layouts.app')

@section('content')
<section>
  <div class="tr-register">
    <div class="tr-regi-form">
      <h4>Create an Account
      </h4>
      <p>It's free and always will be.
      </p>
      <form class="col s12" method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf
        <div class="row">
          <div class="input-field col s12">
            <input type="text" name="name" class="validate" required>
            <label>Full Name
            </label>
            @error('name')
                 <strong>{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="number" name="mobile_no" class="validate" required>
            <label>Mobile
            </label>
            @error('mobile_no')
                 <strong>{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="email" name="email" class="validate" required>
            <label>Email
            </label>
            @error('email')
                 <strong>{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="password"  name="password" class="validate" required>
            <label>Password
            </label>
            @error('password')
                 <strong>{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <span style="color: red;float: left;">* Minimum 6 Characters</span>
        <div class="row">
          <div class="input-field col s12">
            <input type="password" name="password_confirmation" class="validate" required>
            <label>Confirm Password
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="submit" value="submit" class="waves-effect waves-light btn-large full-btn"> 
          </div>
        </div>
      </form>
      <p>Are you a already member ? 
        <a href="{{ route('login') }}">Click to Login
        </a>
      </p>
    </div>
  </div>
</section>
@endsection
