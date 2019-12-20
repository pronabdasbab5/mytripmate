@extends('layouts.app')

@section('content')
<section>
  <div class="tr-register">
    <div class="tr-regi-form">
      <h4>Sign In
      </h4>
      <p>It's free and always will be.
      </p>
      <form class="col s12" method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <div class="row">
          <div class="input-field col s12">
            <input type="text" name="email" class="validate">
            <label>User Name
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="password" name="password" class="validate">
            <label>Password
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="submit" value="submit" class="waves-effect waves-light btn-large full-btn"> 
          </div>
        </div>
      </form>
      <p>Are you a new user ? 
        <a href="{{ route('register') }}">Register
        </a>
      </p>
      <!-- <div class="soc-login">
        <h4>Sign in using</h4>
        <ul>
        <li><a href="#"><i class="fa fa-facebook fb1"></i> Facebook</a> </li>
        <li><a href="#"><i class="fa fa-twitter tw1"></i> Twitter</a> </li>
        <li><a href="#"><i class="fa fa-google-plus gp1"></i> Google</a> </li>
        </ul>
        </div> -->
    </div>
  </div>
</section>
@endsection
