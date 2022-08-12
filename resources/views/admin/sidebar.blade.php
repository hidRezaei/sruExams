<div id="mySlidenav" class="slidenav">
    <p class="logo"><span>S</span>ruExams</p>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-eye"></i></span>
        نمایش وب سایت
    </a>
    <a href="{{route('adminDashboard')}}" class="icon-a @if(request()->is('admin/dashboard')) is-active  @endif">
        <span class="icon"><i class="fas fa-home"></i></span>
        داشبورد
    </a>

    @if(auth()->user()->Role == config('constants.Role.ADMIN'))
        <a href="{{route('student.index')}}" class="icon-a @if(str_contains(url()->current(),'admin/student')) is-active  @endif">
            <span class="icon"><i class="fas fa-school"></i></span>
            دانش آموزان
        </a>
        <a href="#" class="icon-a @if(str_contains(url()->current(),'admin/user')) is-active  @endif">
            <span class="icon"><i class="fas fa-users"></i></span>
            کاربران
        </a>
        <a href="{{route('mosaheh.index')}}" class="icon-a @if(str_contains(url()->current(),'admin/mosaheh')) is-active  @endif">
            <span class="icon"><i class="fas fa-users"></i></span>
            مصححین
        </a>
        <a href="{{route('comiteRaes.index')}}" class="icon-a @if(str_contains(url()->current(),'admin/comiteRaes')) is-active  @endif">
            <span class="icon"><i class="fas fa-users"></i></span>
            روسای کمیته
        </a>
        <!--a href="" class="icon-a">
            <span class="icon"><i class="fas fa-users"></i></span>
            پروفایل
        </a-->
        <a href="{{route('admin.message.index',/*auth()->id()*/-10001)}}" class="icon-a @if(str_contains(url()->current(),'message')) is-active  @endif">
            <span class="icon"><i class="fas fa-comment-alt"></i></span>
            اعتراض ها
        </a>
        <a href="{{route('admin.elanat.index',/*auth()->id()*/-10001)}}" class="icon-a @if(str_contains(url()->current(),'elanat')) is-active  @endif">
            <span class="icon"><i class="fas fa-bell"></i></span>
              اعلانات
        </a>
        <a href="{{route('doreh.index')}}" class="icon-a @if(str_contains(url()->current(),'doreh')) is-active  @endif">
            <span class="icon"><i class="fas fa-cog"></i></span>
            دوره ها
        </a>
        <a href="{{route('lesson.index')}}" class="icon-a @if(str_contains(url()->current(),'lesson')) is-active  @endif">
            <span class="icon"><i class="fas fa-cog"></i></span>
            دروس آزمون
        </a>
    @endif
    @if(auth()->user()->Role == config('constants.Role.MOSAHEH'))
        <a href="{{route('tashih')}}" class="icon-a @if(str_contains(url()->current(),'admin/tashih')) is-active  @endif">
            <span class="icon"><i class="fas fa-school"></i></span>
            تصحیح
        </a>
    @endif

    @if(auth()->user()->Role == config('constants.Role.NAZER'))
        <a href="{{route('tashihTaed')}}" class="icon-a @if(str_contains(url()->current(),'admin/tashihTaed')) is-active  @endif">
            <span class="icon"><i class="fas fa-school"></i></span>
            تایید تصحیح
        </a>
    @endif


    <a href="{{route('admin.setting')}}" class="icon-a @if(str_contains(url()->current(),'setting')) is-active  @endif">
        <span class="icon"><i class="fas fa-cog"></i></span>
        تنظیمات
    </a>

    <a  class="icon-a" onclick="logoutUser()">
        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
        خروج
    </a>
    <!--a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-laptop-house"></i></span>
        خانه
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-address-card"></i></span>
        درباره ما
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-book-open"></i></span>
        مقدمه
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-cogs"></i></span>
        خدمات
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-user-friends"></i></span>
        تیم
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-images"></i></span>
        نمونه کارها
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-comment-alt"></i></span>
        نظرات مشتریان
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-headset"></i></span>
        سوالات متداول
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-clipboard-list"></i></span>
        فوتر
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-comment"></i></span>
        نظرات
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-users"></i></span>
        پیام کاربران
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-blog"></i></span>
        بلاگ
    </a-->
</div>
