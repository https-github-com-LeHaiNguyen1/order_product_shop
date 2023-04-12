@extends('.Layouts.Auth.adminOnly-master')
@section('title', '棚卸明細訂正処理')

@push('custom-css')
@endpush

@push('plugins-css')
@endpush

@section('content')
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h1>Ecosystem</h1>
                                        <h4>Login into your ダッシュボード</h4>
                                        <p class="mt-1 mb-5 pb-1">Management in Functional Management System</p>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" onsubmit="return Checklogin();" >
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <input id="email" type="email" oninput="checkinputLogin()" class="form-control form-control-user" name="email"  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">
                                            <span id="email-error" class="error-msg"></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input id="password" type="password" oninput="checkinputLogin()" class="form-control form-control-user"  name="password" required autocomplete="current-password" placeholder="Password">
                                            <lable id="password-error" class="error-msg">
                                            </lable>
                                        </div>
                                        <div class="foform-outline mb-4">
                                            <div class="custom-control custom-checkbox small">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#loginModal"> Login </button>
                                        <span class="d-block text-left my-4 text-muted">— or login with —</span>
                                        <a href="#" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ 'register' }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center justify-content-center gradient-custom-2">
                                <img src="{{asset('admin/img/bg_company.svg')}}" class="w-75" alt="logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-modal')
@stop

@push('plugins-js')
@endpush

@push('custom-js')
<script src="{{ asset('admin/js/checkinput.js') }}"></script>

@endpush