<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/public.css')}}">
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark-red">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="#"><img src="{{asset('images/hayhomWhite.png')}}" alt="Hayhom" style="width: 30px; height: 47px;"></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto fs-3">
                        <li class="nav-item  px-4"><a class="nav-link text-white" href="#">Home</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="#">Contact Us</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="#">About Us</a></li>
                    </ul>
                </div>
                    <ul class="navbar-nav mr-auto fs-3">
                        <li class="nav-item"><a class="nav-link text-white" href="#">title <i class="bi bi-door-closed-fill"></i></a></li>
                        <li class="nav-item"><a class="nav-link text-white mx-3" href="#">title</a></li>
                    </ul>
            </div>
        </nav>

        <div class="container-floid d-flex align-items-center justify-content-center m-0" style="height: 83vh;">
            <div id="phonePart" class="w-50 text-center shadow align-items-center" style="">
                <div class="bg-light-red pt-3 m-0"></div>
                <div class="mb-2">
                    <h1 class="mb-0 mt-0 display-6 mt-4" >Insert Phone</h1>
                    <hr class="text-white">
                </div>
                <form method="POST" action="{{route('store')}}" class="mb-4 text-start mx-5" id="phoneForm">
                    @csrf
                    <div class="mb-2">
                        <div class="">
                            <label for="phone">Phone number</label>
                        </div>
                        <input type="text" class="py-2 w-100 border-0"  id="phone" name="phone" placeholder="Enter phone" >
                    </div>
                    <p class="phoneErr text-danger"></p>
                    <p class="phoneCountry text-success"></p>
                    <!-- <h5 id="phoneValidate" style="color: red;"> **phone is not correct </h5>  -->
                    <button id="submitButton" class="w-100 border-0 bg-light-red fs-3 p-2 mt-4 text-white">Insert</button>
                </form>
            </div>
        </div>
        <footer class="d-flex flex-wrap justify-content-between bg-dark-red align-items-center py-4 ">
            <div class="col-md-4 d-flex align-items-center">
            <p class="text-light mx-3">© 2019 Company, Inc</p>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex mx-3">
            <li class="ms-3 mx-3 text-white"><a class="" href="https://www.youtube.com/channel/UCJOt6yKMpJpxj2-K4PkDR-A"><i class="bi bi-youtube text-light fs-4 display-4" ></i></a></li>
            <li class="ms-3 mx-3 text-light"><a class="" href="https://twitter.com/hayhomapp"><i class="bi bi-twitter text-light fs-4 display-4"></i></a></li>
            <li class="text-light ms-3 mx-3"><a class="" href="https://instagram.com/hayhomapp"><i class="bi bi-instagram text-light fs-4 display-4"></i></a></li>
            </ul>
        </footer>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
        <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/phone.js')}}"></script>
    </body> 
</html>