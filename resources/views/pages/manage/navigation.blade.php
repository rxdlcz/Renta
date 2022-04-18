<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap5.min.css">
    <link rel="stylesheet" href="css/custom-nav.css">
    <link rel="stylesheet" href="css/customAlert.css">
    <link rel="stylesheet" href="css/custom-style.css">

    <link rel="stylesheet" href="datatables/datatables.css">

    <title>Renta - @yield('title')</title>

</head>
<header>

</header>

<body>
    <main>

        <!-- navigation -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidenav" style="width: 280px;">
            <a href="#" class="logo">
                <img src="../img/logo.png" id="icon" alt="User Icon" class="img-fluid" />
            </a>
            <ul class="nav nav-pills flex-column mb-auto">

                <!-- Manage section -->
                <p>Manage</p>
                <hr>
                <li>
                    <a href="dashboard"
                        class="nav-link text-white {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-clock" viewBox="0 0 16 16">
                                <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                            </svg>
                        </span>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="location"
                        class="nav-link text-white {{ 'location' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                        </span>
                        Location
                    </a>
                </li>
                <li>
                    <a href="unit" class="nav-link text-white {{ 'unit' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-house" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                <path fill-rule="evenodd"
                                    d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                            </svg>
                        </span>
                        House Unit
                    </a>
                <li>
                    <a href="tenant" class="nav-link text-white {{ 'tenant' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-people" viewBox="0 0 16 16">
                                <path
                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                            </svg>
                        </span>
                        Tenant
                    </a>
                </li>
                </li>

                <!-- Bills section -->
                <p class="mt-3">bills</p>
                <hr>
                <li>
                    <a href="rentbills"
                        class="nav-link text-white {{ 'rentbills' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-archive" viewBox="0 0 16 16">
                                <path
                                    d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </span>
                        Rent Bills
                    </a>
                </li>
                <li>
                    <a href="electricbills"
                        class="nav-link text-white {{ 'electricbills' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-lightning" viewBox="0 0 16 16">
                                <path
                                    d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1H6.374z" />
                            </svg>
                        </span>
                        Electric Bills
                    </a>
                </li>
                <li>
                    <a href="waterbills"
                        class="nav-link text-white {{ 'waterbills' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-droplet" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                                <path fill-rule="evenodd"
                                    d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                            </svg>
                        </span>
                        Water Bills
                    </a>
                </li>

                <!-- Settings section -->
                <p class="mt-3">settings</p>
                <hr>
                {{-- <li>
                    <a href="role" class="nav-link text-white {{ 'role' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-key" viewBox="0 0 16 16">
                                <path
                                    d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </span>
                        Role
                    </a>
                </li> --}}
                <li>
                    <a href="user" class="nav-link text-white {{ 'user' == request()->path() ? 'active' : '' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd"
                                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                        </span>
                        User
                    </a>
                </li>
            </ul>
            <hr>

            <!-- Profile section -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ $data->firstname }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#" >New project...</a></li>
                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                    <li><a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout">Sign out</a></li>
                </ul>
            </div>
        </div>

        {{-- Profile Modal --}}

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/editProfile/{{ $data->id }}" method="post">
                        @csrf
                        <div class="container d-flex align-items-center justify-content-center mt-3">
                            <img src="https://github.com/mdo.png" alt="" height="200" width="200" class="rounded-circle img-fluid">
                        </div>
                        <div class="container px-5 mt-2">
                            <input type="file" class="form-control" id="profileImg">
                        </div>
                        
                        <div class="modal-body mt-3">
                            <label class="mx-1">Firstname</label>
                            <input type="text" name="firstname" class="form-control" value="{{ $data->firstname }}" required>
                            <span class="txt_error text-danger mx-1 tenant_id_error"></span>

                            <label class="mx-1">Lastname</label>
                            <input type="text" name="lastname" class="form-control" value="{{ $data->lastname }}" required>
                            <span class="txt_error text-danger mx-1 tenant_id_error"></span>

                            <label class="mx-1">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $data->email }}" required>
                            <span class="txt_error text-danger mx-1 tenant_id_error"></span>

                            <label class="mx-1">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $data->username }}" required>
                            <span class="txt_error text-danger mx-1 tenant_id_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid my-5 mx-5 p-5 cus-container">
            @yield('content')
        </div>

    </main>
    <footer></footer>
    <script type="text/javascript" src="js/bootstrap5.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery-3.5.0.min.js"></script>
    <script type="text/javascript" src="datatables/datatables.js"></script>
    <script src="jquery/jquery-ui.js"></script>

    <script>
        var fetchURL = window.location.pathname;

        $(document).ready(function() {

            getData(fetchURL);
            actionButton();
            buttonFunction();
        });

        //Table properties
        var table = $('#table-content').DataTable({
            "scrollY": "530px",
            "scrollCollapse": true,
            "paging": false,
            "scrollX": true,
            "scroller": true,
            "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                },
                {
                    "targets": -1,
                    "className": "text-center",
                }
            ]
        });

        //Modal  Draggable
        $('.modal>.modal-dialog').draggable({
            cursor: 'move',
            handle: '.modal-header'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
    </script>

    @yield('javascript')
</body>

</html>


{{-- <script>
    $('button').click(function(){
      $('.alert').addClass("show");
      $('.alert').removeClass("hide");
      $('.alert').addClass("showAlert");
      setTimeout(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      },5000);
    });
    $('.close-btn').click(function(){
      $('.alert').removeClass("show");
      $('.alert').addClass("hide");
    });
 </script> --}}
