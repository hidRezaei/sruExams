@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>دوره ها</h2>
        <a href="{{route('doreh.create')}}" ><button type="button" class="btn btn-primary btn-lg">جدید</button></a>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>وضعیت</th>
                <th>جزئیات</th>
                <th>حذف</th>
            </tr>

            @php $counter =1 @endphp
            @foreach($doreha as $doreh)
                <tr>
                    <td>{{ $counter++}}</td>
                    <td>{{$doreh->Title}}</td>
                    <td><input class="form-check-input" type="checkbox" @if($doreh->Status)  {{'checked'}} @endif /></td>
                    <td><a href="{{route('doreh.edit', ['did'=>$doreh->id] )}}" class="text-blue text-decoration-none"> <i class="fas fa-edit"></i></a></td>
                    <td>
                        <a href="{{route('doreh.destroy',['did'=>$doreh->id])}}" class="text-decoration-none text-danger" onclick="destroyMsg(event, {{$doreh->id}})">حذف</a>
                        <form action="{{route('doreh.destroy', ['did'=>$doreh->id])}}" method="post" id="delete-msg-{{$doreh->id}}">
                            @csrf
                            @method('delete')
                        </form>


                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{  $doreha->links()  }}

    </div>

@endsection
@section('js')

    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "دوره با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "دوره با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif


    <script>
        function destroyMsg(event, id){
            event.preventDefault();
            Swal.fire({
                title: 'حذف اعلان',
                text: "آیا از حذف دوره مطمئن هستید؟",
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
