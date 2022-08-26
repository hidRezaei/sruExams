@extends('student.master')

@section('content')
<div style="min-height: 300px">
    @if($dorehTitle == false)
        <div class="alert alert-success  " role="alert">
            <span><h4><b> در حال حاضر آزمون فعالی تعریف نشده است</b></h4></span>
        </div>
    @else
        <div class="alert alert-success  " role="alert">
            <span><h4><b> دوره {{ $dorehTitle }} -  مرحله {{ $stepTitle }}</b></h4></span>
        </div>
        @if($answerViewStatus == false)
            <div class="alert alert-primary" role="alert">
                <span><h4><b>در حال حاضر امکان مشاهده پاسخنامه وجود ندارد</b></h4></span>
            </div>
        @else

            @php
                $examClass = new \App\Models\Exam();
                $student = new \App\Models\Student();
            @endphp

            @foreach($validExams as $exam)
                <div class="alert alert-primary " role="alert">
                    <span><h4><b> آزمون {{$examClass->getExamLessonTitle($exam) }} </b></h4></span>
                </div>
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
                    <br/><br/>
                @endforeach
            @endforeach
       @endif
    @endif
</div>

@endsection
