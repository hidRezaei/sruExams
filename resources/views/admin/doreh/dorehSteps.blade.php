@extends('admin.index')
@section('content')
    <div class="dynamic-content">
        <h2>مراحل دوره</h2>

        <div class="dynamic-content">
            {!! Form::open(['route'=>array('dorehStepStore',request()->did), 'method'=>'post']) !!}
            {!! Form::hidden('DorehID', request()->did) !!}
            @error('DorehID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
            <div class="form-group">
                {!! Form::label('Status', 'فعال',['style'=>'width:5%;display:inline']) !!}
                {!! Form::checkbox('Status',null,null,['style'=>'width:5%']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('Title',null ,['placeholder'=>'عنوان دوره']) !!}
                @error('Title')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::textarea('Description',null ,['placeholder'=>'توضیحات','Style'=>'height:100px;width:40%']) !!}
                @error('Description')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>


            <div class="form-group">
                {!! Form::submit('ثبت مرحله جدید در دوره',['class'=>'panel-btn']) !!}
            </div>
            {!! Form::close() !!}






        <hr/>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>عنوان</th>
                <th>وضعیت</th>
                <th>عملیات</th>
                <th>حذف</th>
            </tr>

            @foreach($steps as $step)
                <tr>
                    <td>{{$step->Title}}</td>
                    <td><input class="form-check-input" type="checkbox" @if($step->Status)  {{'checked'}} @endif /></td>
                    <td><a href="{{route('dorehStepLessons', ['did'=>request()->did,'sid'=>$step->id])}}" class="text-blue text-decoration-none">اختصاص درس به دوره</a></td>

                    <td>
                        <a href="{{route('dorehStepDestroy',['sid'=>$step->id])}}" class="text-decoration-none text-danger" onclick="destroyMsg(event, {{$step->id}})">حذف</a>
                        <form action="{{route('dorehStepDestroy', ['sid'=>$step->id])}}" method="post" id="delete-msg-{{$step->id}}">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
            <a href="{{route('doreh.edit',['did'=>request()->did])}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">بازگشت به دوره</button></a>
            <br/>
            <br/>

    </div>

@endsection
@section('js')

    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "مرحله دوره با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "مرحله دوره با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif


    <script>
        function destroyMsg(event, id){
            event.preventDefault();
            Swal.fire({
                title: 'حذف اعلان',
                text: "آیا از حذف مرحله دوره مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'بله, مطمئن هستم!',
                cancelButtonText: 'نه حذف نکن'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('#delete-msg-'+id).submit();
                }
            })

        }

    </script>

@endsection
