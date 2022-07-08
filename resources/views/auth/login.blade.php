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

        .card-cst-1{
            border-radius: 0 !important;
            border-top-right-radius: 0.25rem !important;
            border-bottom-right-radius: 0.25rem !important;
        }

        .card-cst-2{
            border-radius: 0 !important;
            border-top-left-radius: 0.25rem !important;
            border-bottom-left-radius: 0.25rem !important;
        }


    </style>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card-group mb-0">
                    <div class="card p-4 card-cst-1 ">
                        <div class="card-body">

                            <form action="{{route('login.store')}}" method="post">
                                @csrf

                                <h3 class=" fw-bold"> ورود </h3>
                                <p class="text-muted">حساب کاربری مدیر</p>
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
                                        <button type="submit" class="btn btn-primary px-4">ورود</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <input type="checkbox" name="remember">
                                        مرا به خاطر بسپار
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none card-cst-2 " style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <img src="{{asset('images/logo2.png')}}" width="130" style="margin-left:30px !important;" />
                                <img src="{{asset('images/ped.png')}}" width="100" />
                                <h2>سامانه آزمون</h2>
                                <p>باشگاه دانش پژوهان جوان</p>
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
