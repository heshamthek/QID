@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-outline mb-4">
                    <input type="email" id="typeEmailX-2" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    <label class="form-label" for="typeEmailX-2">Email</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-4">
                    <input type="password" id="typePasswordX-2" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                    <label class="form-label" for="typePasswordX-2">Password</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-start mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="form1Example3" {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>

                <hr class="my-4">

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

            </form>

            <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" type="button"><i class="fab fa-google me-2"></i> Sign in with google</button>
            <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="button"><i class="fab fa-facebook-f me-2"></i> Sign in with facebook</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
