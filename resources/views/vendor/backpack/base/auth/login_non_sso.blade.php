@extends(backpack_view('layouts.plain'))
@push('after_styles')
    <style>
        .grecaptcha-badge {
            visibility: hidden !important;
        }
    </style>
@endpush
@section('content')
    <section class="body-sign">
        <div class="center-sign">
            <a href="/" class="logo float-left">
                <img src="{{ url(config('app.url') . '/frontpage/img/logo.png') }}" height="70" alt="Halaman Pengelola PPID HUMAS POLIJE" />
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> {{ trans('backpack::base.login') }}</h2>
                </div>
                <div class="card-body form" id="web-jurusan-login">
                    <form role="form" method="POST" action="{{ route('backpack.auth.login') }}">
                        {!! csrf_field() !!}
							<div class="form-group mb-3">
								<label for="{{ $username }}">{{ config('backpack.base.authentication_column_name') }}</label>
								<div class="input-group">
									<input type="text" tabindex="1" class="form-control form-control-lg {{ $errors->has($username) ? ' is-invalid' : '' }}" name="{{ $username }}" value="{{ old($username) }}" id="{{ $username }}"/>
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-user"></i>
										</span>
									</span>
                                     @if ($errors->has($username))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first($username) }}</strong>
                                    </span>
                                @endif
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="clearfix">
									<label for="password">{{ trans('backpack::base.password') }}</label>
									  @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                                <a href="{{ route('backpack.auth.password.reset') }}" tabindex="5" class="float-right">{{ trans('backpack::base.forgot_your_password') }}</a>
                                @endif
								</div>
								<div class="input-group">
									<input type="password" tabindex="2" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password"/>
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-lock"></i>
										</span>
									</span>
                                     @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input type="checkbox" tabindex="3" name="rememberme" id="RememberMe"/>
										<label for="RememberMe">{{ trans('backpack::base.remember_me') }}</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" tabindex="4" class="btn btn-primary hidden-xs"> {{ trans('backpack::base.login') }}</button>
								</div>
							</div>
							
						</form>
                    
                </div>
            </div>

            <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2025. All Rights Reserved.</p>
        </div>
    </section>
@endsection
