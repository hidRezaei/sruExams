<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-lg">

            <div class="hamburger-menu">
                <i class="fas fa-bars"></i>
            </div>


            <ul class="navbar-nav">
                <div class="close-menu">
                    <i class="fas fa-times"></i>
                </div>
                <li class="nav-item">
                    <a class="nav-link active" href="#">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">درباره ما</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">خدمات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">پروژه ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">بلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">تماس با ما</a>
                </li>

            </ul>


            <div class="logo">
                <a href="">TopLearn</a>
            </div>
        </div>
    </nav>

    <div class="overlay-menu"></div>
</header>

<div class="auth-user">

    @guest
        <div class="auth-users">
            <a href="{{route('register')}}">ثبت نام</a>
            /
            <a href="{{route('login')}}">ورود</a>
        </div>

    @else
        <div class="profile">
            <div class="prof mb-3">
                <a href="{{route('dashboard')}}" target="_blank">پروفایل</a>
            </div>
            <div class="logout" style="cursor: pointer">
                <div onclick="logoutUser()">خروج</div>
            </div>
        </div>

        <form action="{{route('logout')}}" method="post" id="logout">
            @csrf
        </form>


    @endguest

    <div class="auth-user-icon">
        <i class="fas fa-cog fa-spin"></i>
    </div>
</div>

