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
                                        <h5>Forgot Password your ダッシュボード</h5>
                                        <p class="mt-1 mb-5 pb-1">Management in Functional Management System</p>
                                    </div>
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block"> Send Password Reset Link</button>     
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('login')}}">Login</a>
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
@endpush


















