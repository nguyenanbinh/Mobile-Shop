@extends('layouts.app')
@section('content')
    <!-- LOGIN -->
		<div  class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="border-login">
							<h2 id="title-login">Login</h2>
                            <form id="login-form" action="{{ route('login.perform') }}" method="POST" >
                                @csrf
                                <!-- Email input -->
                                <div class="form-group">
                                    <input type="email" id="email-input" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control" />
                                    @error('email')
                                    <span class="text-danger"> {{$message ?? ''}} </span>
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-group">
                                  <input type="password" id="password-input" name="password" placeholder="Password" class="form-control" />
                                  @error('password')
                                  <span class="text-danger"> {{$message ?? ''}} </span>
                                  @enderror
                                </div>

                                <!-- 2 column grid layout for inline styling -->
                                <div class="row mb-4">
                                  <div class="col d-flex remember">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="form2Example31" />
                                      <label class="form-check-label" for="form2Example31"> Remember me </label>
                                    </div>
                                  </div>

                                  <div class="forget-pwd">
                                    <!-- Simple link -->
                                    <a href="#!" >Forgot password?</a>
                                  </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" style="margin:1em auto;max-width: 50%" class="btn btn-primary btn-block mb-4">Sign in</button>

                              </form>

						</div>

					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /LOGIN -->

@endsection

@push('css')
    <style>
        #login-form{
            max-width: 50%;
            margin: 1em auto;

        }
        .border-login {
            border: 2px solid #10cedb;
            margin: 1.5% 15%;
        }

        #title-login{
            margin-top: 1vh;
            text-align: center;
        }
        .forget-pwd{
            text-align: center;
        }
        .remember {
            margin-left: 1em;
        }
        .text-danger{
            margin-left: 1%;
        }

        #email-input {
            margin-bottom: 5px;

        }

        #password-input {
            margin-bottom: 5px;
        }
    </style>
@endpush

