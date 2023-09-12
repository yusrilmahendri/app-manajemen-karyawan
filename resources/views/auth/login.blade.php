<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LOGIN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Styles -->
  @include('auth.templates.style')
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <h1>
                  DR. GRAPHIA
                </h1>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="{{ url('login') }}" novalidate>
                    {{ csrf_field() }}

                    <div class="col-12">
                      <div class="form-group @error('email') has-error @enderror">
                        <label for="yourEmail" class="form-label">Email atau username</label>

                        <input type="text" name="email" class="form-control" id="yourEmail" 
                          required autocomplete="email" value="{{ old('email') }}" autofocus>

                        @error('email') 
                         <span class="help-block"> {{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12 @error('password') @enderror">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" 
                      id="yourPassword" required>
                      
                      @error('password')
                         <span class="help-block"> {{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>
            </div> 
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <! -- scripts -->
  @include('auth.templates.scripts')
</body>
</html>