@extends('front.layouts.master')

@section('content')

    <style>

        .text-muted {
            color: #9faecb !important;
            margin-bottom: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .input-group {
            position: relative;
            display: flex;
            width: 100%;
        }

        .lgnTxt{
            border-radius: 0 !important;
            border-top-left-radius: 0.25rem !important;
            border-bottom-left-radius: 0.25rem !important;

        }

        .input-group-addon {
            padding: .5rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.25;
            color: #495057;
            text-align: center;
            background-color: #e9ecef;
            border: 1px solid rgba(0,0,0,.15);
            border-left: 0;
            border-right-color: rgba(0, 0, 0, 0.15);
            border-right-style: solid;
            border-right-width: 1px;
            border-top-right-radius: 0.25rem !important;
            border-bottom-right-radius: 0.25rem !important;

        }

        .bg-orange{background-color: #ffa62b !important;}


    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">

                            <form action="{{route('login.store')}}" method="post">
                                @csrf

                                <h3 class="fw-bold"> ورود </h3>
                                <p class="text-muted">حساب کاربری دانش آموزان</p>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="email" class="form-control lgnTxt" placeholder="نام کاربری">

                                </div>
                                @error('email')
                                <p class="text-danger my-2">{{$message}}</p>
                                @enderror
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" placeholder="رمز عبور" class="form-control lgnTxt" >

                                </div>
                                @error('password')
                                <p class="text-danger my-2">{{$message}}</p>
                                @enderror
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary bg-orange px-4">ورود</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <input type="checkbox" name="remember">
                                        مرا به خاطر بسپار
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card text-white bg-orange py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>سامانه آزمون</h2>
                                <p>متن توضیحات متن توضیح متن توضیح متن توضیحات متن توضیح متن توضیح متن توضیحات متن توضیح متن توضیح </p>
                                <button type="button" class="btn btn-light active mt-3">وارد شوید!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('front.partials.footer')--}}
@endsection
