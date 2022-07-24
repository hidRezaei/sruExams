@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>اعلانات</b></h4></span>
        </div>
        <a href="{{route('admin.elanat.create',-10001)}}" ><button type="button" class="btn btn-primary btn-lg">جدید</button></a>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>متن</th>
                <th>تاریخ</th>
                <th>جزئیات</th>
                <th>حذف</th>
            </tr>

            @php $counter =1 @endphp
            @foreach($elanats as $elanat)
                <tr>
                    <td>{{ $counter++}}</td>
                    <td>{{$elanat->Title}}</td>
                    <td>{{ Str::limit($elanat->Text,30) }}</td>
                    <td>{{ verta($elanat->created_at)->format('H:i  -  Y/m/d ')  }}</td>
                    <td><a href="{{route('admin.elanat.edit', ['aid'=> -10001,'eid'=>$elanat->id] )}}" class="text-blue text-decoration-none"> <i class="fas fa-edit"></i></a></td>
                    <td>
                        <a href="{{route('admin.elanat.destroy',['aid'=> -10001,'eid'=>$elanat->id])}}" class="text-decoration-none text-danger" onclick="destroyMsg(event, {{$elanat->id}})">حذف</a>
                        <form action="{{route('admin.elanat.destroy', ['aid'=> -10001,'eid'=>$elanat->id])}}" method="post" id="delete-msg-{{$elanat->id}}">
                            @csrf
                            @method('delete')
                        </form>


                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{  $elanats->links()  }}

    </div>

@endsection
@section('js')

    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "اعلان با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "اعلان با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif


    <script>
        function destroyMsg(event, id){
            event.preventDefault();
            Swal.fire({
                title: 'حذف اعلان',
                text: "آیا از حذف اعلان مطمئن هستید؟",
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
