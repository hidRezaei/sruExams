@extends('admin.index')
@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>مراحل دوره</b></h4></span>
        </div>
        <div class="dynamic-content">
            {!! Form::open(['route'=>array('dorehStepStore',request()->did), 'method'=>'post']) !!}
            {!! Form::hidden('DorehID', request()->did) !!}
            @error('DorehID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror

            <div class="form-container">
                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('Status', 'فعال',['style'=>'width:5%;display:inline']) !!}
                        {!! Form::checkbox('Status',null,null,['style'=>'width:5%']) !!}
                    </div>
                    <div class="form-group-cell col">
                    </div>
                </div>

                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('Title', 'عنوان مرحله') !!}
                        {!! Form::text('Title',null ,['placeholder'=>'عنوان مرحله']) !!}
                        @error('Title')
                        <p class="text-danger my-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group-cell col">
                    </div>
                </div>

                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::textarea('Description',null ,['placeholder'=>'توضیحات']) !!}
                        @error('Description')
                        <p class="text-danger my-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group-cell col">
                    </div>
                </div>

                <div class="form-group-row" style="text-align: left">
                    <div class="form-group-cell">
                        {!! Form::submit('ثبت مرحله جدید در دوره',['class'=>'admin-panel-btn btn-green']) !!}
                    </div>
                    <div class="form-group-cell">
                        <a href="{{route('dorehSteps',['did'=>request()->did])}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست دوره</button></a>
                    </div>
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
