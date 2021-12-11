<nav class="navbar ">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content mt-1">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>

        @auth
            <ul class="navbar-nav">
                {{-- profil --}}
                <li class="nav-item dropdown nav-profile">
                    {{-- gambar profil --}}
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <div class="dropdown-header d-flex flex-column align-items-center">
                            <div class="figure mb-3">
                                <img src="{{ url('https://via.placeholder.com/80x80') }}" alt="">
                            </div>
                            <div class="info text-center">
                                <p class="name font-weight-bold mb-0">{{ auth()->user()->name }}</p>
                                <p class="email text-muted mb-3">{{ auth()->user()->roles['role_name'] }}</p>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <ul class="profile-nav p-0 pt-2">
                                <li class="nav-item">
                                    <button class="btn btn-outline-danger mx-auto" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i data-feather="log-out"></i>
                                        <span>Logout</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            @else
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                    <a href="/login" type="button" class="btn btn-outline-primary btn-icon-text mr-2">
                        <i class="btn-icon-prepend" data-feather="log-in"></i>Login
                    </a>
                </div>
            @endauth
        </ul>
    </div>
</nav>


{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <form action="/logout" method="post">
                @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>
