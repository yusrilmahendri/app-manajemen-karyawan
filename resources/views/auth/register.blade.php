<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>REGISTER</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
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
                  </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" action="{{ url('register') }}" method="POST" novalidate>
                    
                    {{csrf_field()}}

                    <div class="form-gorup @error('name') has-error @enderror">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                      
                      @error('name')
                        <span class="help-block"> {{ $message }}</span>
                      @enderror
                    </div>


                    <div class="col-12">
                      <div class="form-group @error('email') has-error @enderror">
                        <label for="yourEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="yourEmail" 
                          required autocomplete="email" value="{{ old('email') }}" autofocus>

                        @error('email') 
                         <span class="help-block"> {{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group @error ('password') has-error @enderror">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" 
                          required autocomplete="password" value="{{ old('password') }}" autofocus>
                        
                          @error('password')
                            <span class="help-block"> {{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                      <label for="yourEmail" class="form-label">Phone</label>
                      <input type="phone" name="phone" class="form-control" id="phone" required autocomplete="phone" value="{{ old('phone') }}" autofocus>
                    
                        @error('phone')
                          <span class="help-block"> {{ $message }}</span>
                         @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Gender</label>
                      <select class="form-select" name="gender" aria-label="Default select example">
                        <option selected value="pria">Pria</option>
                        <option value="perempuan">Wanita</option>
                      </select>
                    </div>

                    <div class="col-12">
                      <div class="form-group @error('alamat') has-error @enderror">
                        <label for="yourAlamat" class="form-label" name="alamat">Alamat</label>
                      <textarea class="form-control" name="alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                        
                      @error('alamat')
                         <span class="help-block"> {{ $message }}</span>
                      @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    
                  </form>
                  <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="{{ url('/login') }}">Log in</a></p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('auth.templates.scripts')

</body>

</html>