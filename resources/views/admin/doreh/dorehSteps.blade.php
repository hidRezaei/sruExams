@extends('admin.index')
@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>مراحل دوره</b></h4></span>
        </div>
        <div class="dynamic-content">
        <a href="{{route('dorehStepCreate',request()->did)}}" ><button type="button" class="btn btn-primary btn-lg mb-3">دوره جدید</button></a>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>عنوان مرحله</th>
                <th>وضعیت</th>
                <!--th>عملیات</th-->
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>

            @foreach($steps as $step)
                <tr>
                    <td>{{$step->Title}}</td>
                    <td><input class="form-check-input" type="checkbox" @if($step->Status)  {{'checked'}} @endif /></td>
                    <!--td><a href="{{route('dorehStepLessons', ['did'=>request()->did,'sid'=>$step->id])}}" class="text-blue text-decoration-none">اختصاص درس به دوره</a></td-->
                    <td><a href="{{route('dorehStepEdit', ['did'=>request()->did,'sid'=>$step->id] )}}" class=" text-decoration-none"> <i class="fas fa-edit"></i></a></td>
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

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    <a href="{{route('doreh.edit',['did'=>request()->did])}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به دوره</button></a>
                </div>
            </div>

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
                cancelButtonText: 'انصراف از حذف'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('#delete-msg-'+id).submit();
                }
            })

        }

    </script>

@endsection
