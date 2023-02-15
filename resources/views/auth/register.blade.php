@extends('layouts.app')
@section('content')
    <!-- REGISTER -->
		<div id="register" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="register" >
							<h2 id="title-login">{{ __('Register') }}</h2>
                            <form id="login-form" action="{{ route('register.perform') }}" method="POST" >
                                @csrf
                                <!-- Name input -->
                                <div class="form-group">
                                  <input type="name" id="name-input" name="name" placeholder="Name" class="form-control" />
                                  @error('name')
                                  <span class="text-danger"> {{$message ?? ''}} </span>
                                  @enderror
                                </div>

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

                                <!-- Submit button -->
                                <button type="submit" style="margin:1em auto;max-width: 50%" class="btn btn-primary btn-block mb-4">{{ __('Register') }}</button>
                              </form>

						</div>

					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /REGISTER -->

@endsection

@push('css')
    <style>
        #login-form{
            max-width: 50%;
            margin: 1em auto;

        }
        .newsletter1 {
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

