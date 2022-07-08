@extends('student.master')

@section('content')
    <span class="nav2">
        پاسخ سوالات آزمون
    </span>

    <div style="min-height: 300px">
        @php
            $examClass = new \App\Models\Exam();
            $student = new \App\Models\Student();
        @endphp

        <!--img src="{{ asset('/getAns/1/1.jpg') }}" style="border:1px solid black" width="200" /-->
        <!--img src="{{ route('image.displayImage' , ['lessonNumber'=>1,'QN'=>'1', 'filename'=>'1.jpg']) }}" style="border:1px solid black" width="200" /-->
        @foreach($validExams as $exam)
            <p style="padding-right:30px;line-height:300%;color:yellow;background-color:black">{{' آزمون ' . $examClass->getExamLessonTitle($exam) }}</p>
            @php
                $questionNumber = $student->getQuestionCount($exam);
            @endphp

            @foreach($questionNumber as $question)
                <p>{{' سوال ' . $question}}</p>
                @php
                    $answerPage = $student->getAnswerPagesOfQuestion($exam,$question);
                @endphp
                @foreach ($answerPage as $page)
                    <a href="{{route('image.displayImage' , ['lessonNumber'=>$exam,'QN'=>$question, 'filename'=>$page]) }}" target="_blank">
                        <img src="{{ route('image.displayImage' , ['lessonNumber'=>$exam,'QN'=>$question, 'filename'=>$page]) }}"
                            style="border:1px solid black" width="200"/></a>
                @endforeach
            @endforeach
        @endforeach

        <p style="padding-right:30px;line-height:300%;color:yellow;background-color:black">دریافت کارنامه</p>
        <a href="{{route('student.karname') }}">برای دریافت فایل کارنامه کلیک کنید</a>

        <p>
            @php
                //echo \App\Http\Controllers\Student\homeController::getQuestionCount();
                //echo \App\Http\Controllers\Student\homeController::getAnswerPagesOfQuestion(1);

            @endphp</p>
    </div>

@endsection
