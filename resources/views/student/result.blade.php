@extends('student.home')

@section('content')
    <span class="nav2">
        پاسخ سوالات آزمون
    </span>

    <div style="min-height: 300px">

        <!--img src="{{ asset('/getAns/1/1.jpg') }}" style="border:1px solid black" width="200" /-->
        <!--img src="{{ route('image.displayImage' , ['QN'=>'1', 'filename'=>'1.jpg']) }}" style="border:1px solid black" width="200" /-->

        @foreach($questionNumber as $question)
            <p>{{' سوال ' . $question}}</p>
                @php
                    $student = new \App\Models\Student();
                    $answerPage = $student->getAnswerPagesOfQuestion($question);
                @endphp
                    @foreach ($answerPage as $page)
                <a href="{{route('image.displayImage' , ['QN'=>$question, 'filename'=>$page]) }}" target="_blank"><img src="{{ route('image.displayImage' , ['QN'=>$question, 'filename'=>$page]) }}" style="border:1px solid black" width="200" /></a>
                    @endforeach
        @endforeach


        <p>
                @php
                    //echo \App\Http\Controllers\Student\homeController::getQuestionCount();
                    //echo \App\Http\Controllers\Student\homeController::getAnswerPagesOfQuestion(1);

            @endphp</p>
    </div>

@endsection
