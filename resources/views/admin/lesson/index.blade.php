@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>درس های آزمون</b></h4></span>
        </div>
        <a href="{{route('lesson.create')}}" ><button type="button" class="btn btn-primary btn-lg">جدید</button></a>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>کد</th>
                <th>جزئیات</th>
                <th>حذف</th>
            </tr>

            @php $counter =1 @endphp
            @foreach($data as $dataItem)
                <tr>
                    <td>{{ $counter++}}</td>
                    <td>{{$dataItem->Title}}</td>
                    <td> {{$dataItem->Code}} </td>
                    <td><a href="{{route('lesson.edit', ['lid'=>$dataItem->id] )}}" class="text-blue text-decoration-none"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <a href="{{route('lesson.destroy',['lid'=>$dataItem->id])}}" class="text-decoration-none text-danger" onclick="destroyMsg(event, {{$dataItem->id}})">حذف</a>
                        <form action="{{route('lesson.destroy', ['lid'=>$dataItem->id])}}" method="post" id="delete-msg-{{$dataItem->id}}">
                            @csrf
                            @method('delete')
                        </form>


                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{  $data->links()  }}

    </div>

@endsection
@section('js')

    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "درس با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "درس با موفقیت ویرایش شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif


    <script>
        function destroyMsg(event, id){
            event.preventDefault();
            Swal.fire({
                title: 'حذف اعلان',
                text: "آیا از حذف درس مطمئن هستید؟",
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
