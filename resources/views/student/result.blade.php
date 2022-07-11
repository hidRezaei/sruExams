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
            <p style="margin:40px 5px 10px 0 ;padding-right:30px;line-height:300%;color:yellow;background-color:black; border-radius: 7px">{{' آزمون ' . $examClass->getExamLessonTitle($exam) }}</p>
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

            @php /*
            <p style="margin:10px 5px 10px 0 ;padding-right:30px;line-height:200%;color:white;background-color:#6610f2; border-radius: 7px"> کارنامه آزمون {{$examClass->getExamLessonTitle($exam) }} </p>
            <a href="{{route('student.karname', ['lessonNumber'=>$exam]) }}" style="margin-right: 50px;text-decoration: none">برای دریافت فایل کارنامه کلیک کنید</a>
            */ @endphp
        @endforeach


        @foreach($validExamsForKaname as $exam)
            <p style="margin:10px 5px 10px 0 ;padding-right:30px;line-height:200%;color:white;background-color:#6610f2; border-radius: 7px"> کارنامه آزمون {{$examClass->getExamLessonTitleForkarname($exam) }} </p>
            <a href="{{route('student.karname', ['lessonNumber'=>$exam]) }}" style="margin-right: 50px;text-decoration: none">برای دریافت فایل کارنامه کلیک کنید</a>
        @endforeach


        <p>
            @php
                //echo \App\Http\Controllers\Student\homeController::getQuestionCount();
                //echo \App\Http\Controllers\Student\homeController::getAnswerPagesOfQuestion(1);

            @endphp</p>
    </div>

@endsection
