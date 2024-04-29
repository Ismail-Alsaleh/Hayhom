<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

        <style>
            .error{
                color: red !important;
            }
            label.error{
                width: 100%;
            }
        </style>
        <title>@yield("title")</title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-header">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="{{route('blogUser.blog')}}"><img src="{{asset('images/hayhomWhite.png')}}" alt="Hayhom" style="width: 30px; height: 47px;"></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto fs-3">
                        <li class="nav-item  px-4"><a class="nav-link text-white" href="{{route('blogUser.blog')}}">Home</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="{{route('blogUser.contact_us')}}">Contact Us</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="{{route('blogUser.about_us')}}">About Us</a></li>
                    </ul>
                </div>
                    <ul class="navbar-nav mr-auto fs-3">
                    @if (Auth::check())
                        <li class="nav-item"><a class="nav-link text-white" href="{{route('blogUser.logout')}}">Logout <i class="bi bi-door-closed-fill"></i></a></li>
                    @else
                        <li class="nav-item"><a class="nav-link text-white" href="{{route('blogUser.login')}}">login <i class="bi bi-door-open-fill"></i></a></li>
                    @endif
                        <li class="nav-item"><a class="nav-link text-white mx-3" href="{{route('blogUser.post_editor')}}">Admin</a></li>
                    </ul>
            </div>
        </nav>

<div class="container-floid d-flex align-items-center justify-content-center bg-custom1 m-0" style="height: 83vh;">
            <div id="registerPart" class="w-50 bg-custom6 text-center shadow align-items-center" style="height: 55%">
                <div class="bg-custom-yellow pt-3 m-0"></div>
                <div class="mb-2">
                    <h1 class="mb-0 mt-0 display-6 mt-4" >Register</h1>
                    <hr class="text-white">
                </div>
                <form method="POST" action="{{route('phone2')}}" class="mb-4 text-start mx-5" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <div class="">
                            <label for="username" class="">Username</label>
                        </div>
                        <input type="text" class="py-2 w-100 border-0" id="username" name="username" placeholder="username" required>
                    </div>
                    <div class="mb-2">
                        <div class="">
                            <label for="phone">Phone number</label>
                        </div>
                        <input type="text" class="py-2 w-100 border-0"  id="phone" name="phone" placeholder="Enter phone" required>
                    </div>
                    <button id="loginButton" class="w-100 border-0 bg-custom5 fs-3 p-2 mt-3 text-white">Register</button>
                </form>

                <footer class="d-flex flex-wrap justify-content-between bg-purple align-items-center py-2 bg-footer">
            <div class="col-md-4 d-flex align-items-center">
            <p class="text-light mx-3">© 2019 Company, Inc</p>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex mx-3">
            <li class="ms-3 text-white"><a class="" href="https://www.youtube.com/channel/UCJOt6yKMpJpxj2-K4PkDR-A"><i class="bi bi-youtube text-light fs-1"></i></a></li>
            <li class="ms-3 text-ligh"><a class="" href="https://twitter.com/hayhomapp"><i class="bi bi-twitter-x text-light fs-1"></i></a></li>
            <li class="text-light ms-3"><a class="" href="https://instagram.com/hayhomapp"><i class="bi bi-instagram text-light fs-1"></i></a></li>
            </ul>
        </footer>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
        <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body> 
</html>