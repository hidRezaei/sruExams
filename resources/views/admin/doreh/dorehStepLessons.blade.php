@extends('admin.index')
@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>اختصاص درس ها</b></h4></span>
        </div>

        <div class="dynamic-content">
            {!! Form::open(['route'=>array('dorehStepLessonsStore',['did'=>request()->did,'sid'=>request()->sid]), 'method'=>'post']) !!}

            {!! Form::hidden('DorehID', request()->did) !!}
            @error('DorehID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
            {!! Form::hidden('StepID', request()->sid) !!}
            @error('StepID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
            <table class="mb-5">
                <tbody>
                <tr>
                    <th>عنوان</th>
                    <th>وضعیت</th>
                    <th>تعداد سوالات</th>
                </tr>

                @foreach($data as $dataItem)
                    <tr>
                        <td>{{$dataItem->Title}}</td>
                        <td>
                            @php
                                $flag = false;
                                if($dataItem->LessonID!= null)
                                    $flag = true;
                            @endphp

                            <div class="form-check form-switch">
                                {!! Form::checkbox('Status['. $dataItem->id .']',null,$flag,['id'=>'chk_'. $dataItem->id,'class'=>'form-check-input','role'=>'switch','style'=>'float:right;position:relative;display:block']) !!}
                            </div>
                        </td>
                        <td>

                            <div class="form-group">
                                {!! Form::text('QCount['. $dataItem->id .']' ,$dataItem->QCount ,['placeholder'=>'فقط عدد']) !!}
                                @error('QCount['. $dataItem->id .']')
                                <p class="text-danger my-2">{{$message}}</p>
                                @enderror
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    {!! Form::submit('ثبت مشخصات درس در دوره',['class'=>'admin-panel-btn btn-green','style'=>'width:220px']) !!}
                </div>
                <div class="form-group-cell">
                    <a href="{{route('dorehSteps',['did'=>request()->did])}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به مراحل دوره</button></a>
                </div>
            </div>

            {!! Form::close() !!}

    </div>

@endsection
@section('js')

    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "اطلاعات با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

@endsection
