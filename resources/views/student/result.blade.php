@extends('student.home')

@section('content')
    <span class="nav2">
        نتایج
    </span>
    <div class="information" >
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-clipboard"></i>
                </div>
                <div class="box-text">
                    <h4>30</h4>
                    <h3>پست ها</h3>
                </div>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="box-text">
                    <h4>250</h4>
                    <h3>کاربران</h3>
                </div>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="box-text">
                    <h4>30</h4>
                    <h3>پروژه ها</h3>
                </div>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-comment"></i>
                </div>
                <div class="box-text">
                    <h4>600</h4>
                    <h3>کامنت</h3>
                </div>
            </div>
        </div>
    </div>

    <div style="min-height: 300px">

        <!--img src="{{ asset('/getAns/1/1.jpg') }}" style="border:1px solid black" width="200" /-->
        <img src="{{ route('image.displayImage' , ['QN'=>'1', 'filename'=>'1.jpg']) }}" style="border:1px solid black" width="200" />

        @foreach($questionNumber as $question)
            <p>{{$question}}</p>
        @endforeach


        <p>
                @php
                    //echo \App\Http\Controllers\Student\homeController::getQuestionCount();
                    //echo \App\Http\Controllers\Student\homeController::getAnswerPagesOfQuestion(1);

            @endphp</p>
    </div>

@endsection
