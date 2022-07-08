@extends('student.master')

@section('content')
    <div class="dynamic-content">
        <h2>پیام ها</h2>
        <a href="{{route('student.message.create',auth('student')->id())}}" ><button type="button" class="btn btn-primary btn-lg">جدید</button></a>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>ردیف</th>
                <th>فرستنده</th>
                <th>گیرنده</th>
                <th>موضوع</th>
                <th>تاریخ</th>
                <th>ویرایش</th>
                <th>حذف</th>
                <!--th>ویرایش</th>
                <th>حذف</th-->
            </tr>

            @php $counter =1 @endphp
            @foreach($messages as $message)
                <tr>
                    <td>{{ $counter++}}</td>
                    <td>{{$message->SenderTitle()}}</td>
                    <td>{{$message->ReceiverTitle()}}</td>
                    <td> {{$message->Subject2}}</td>
                    <td>{{$message->Jalali()}}</td>
                    <td><a href="{{route('student.message.edit', ['sid'=> auth('student')->id(),'mid'=>$message->id] )}}" class="text-blue text-decoration-none"> <i class="fas fa-edit"></i></a></td>
                    <td>
                        <a href="{{route('student.message.destroy',['sid'=> auth('student')->id(),'mid'=>$message->id])}}" class="text-decoration-none text-danger" onclick="destroyMsg(event, {{$message->id}})">حذف</a>
                        <form action="{{route('student.message.destroy', ['sid'=> auth('student')->id(),'mid'=>$message->id])}}" method="post" id="delete-msg-{{$message->id}}">
                            @csrf
                            @method('delete')
                        </form>


                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{  $messages->links()  }}

    </div>

@endsection
@section('js')

    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "پیام با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'توجه',
                text: "پیام با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif


    <script>
        function destroyMsg(event, id){
            event.preventDefault();
            Swal.fire({
                title: 'حذف پیام',
                text: "آیا از حذف پیام مطمئن هستید؟",
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
