@extends('layouts.app')

@section('content')
<div class="container">
   
        <div class="login-box col-md-6 offset-3">
     
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">Sign in to start your session</p>
        
              <form  method="post" {{ route('login') }}>
                @csrf
                <div class="input-group mb-3">
                  <input type="email" class="form-control" placeholder="Email" @error('email') is-invalid @enderror" name="email">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" @error('password') is-invalid @enderror" name="password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                 @enderror
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember">
                      <label for="remember">
                        Remember Me
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
        
             
        
              <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
              </p>
            
            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
        <!-- /.login-box -->




</div>
@endsection





