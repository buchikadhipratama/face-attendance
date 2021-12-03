<nav class="navbar ">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
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
            {{-- notifikasi --}}
            <ul class="navbar-nav">
                <li class="nav-item dropdown nav-notifications">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell"></i>
                        <div class="indicator">
                            <div class="circle"></div>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">

                            <p class="mb-0 font-weight-medium">6 New Notifications</p>
                            <a href="javascript:;" class="text-muted">Clear all</a>
                        </div>
                        <div class="dropdown-body">
                            <a href="javascript:;" class="dropdown-item">
                                <div class="icon">
                                    <i data-feather="user-plus"></i>
                                </div>
                                <div class="content">
                                    <p>New customer registered</p>
                                    <p class="sub-text text-muted">2 sec ago</p>
                                </div>
                            </a>
                            <a href="javascript:;" class="dropdown-item">
                                <div class="icon">
                                    <i data-feather="gift"></i>
                                </div>
                                <div class="content">
                                    <p>New Order Recieved</p>
                                    <p class="sub-text text-muted">30 min ago</p>
                                </div>
                            </a>
                            <a href="javascript:;" class="dropdown-item">
                                <div class="icon">
                                    <i data-feather="alert-circle"></i>
                                </div>
                                <div class="content">
                                    <p>Server Limit Reached!</p>
                                    <p class="sub-text text-muted">1 hrs ago</p>
                                </div>
                            </a>
                            <a href="javascript:;" class="dropdown-item">
                                <div class="icon">
                                    <i data-feather="layers"></i>
                                </div>
                                <div class="content">
                                    <p>Apps are ready for update</p>
                                    <p class="sub-text text-muted">5 hrs ago</p>
                                </div>
                            </a>
                            <a href="javascript:;" class="dropdown-item">
                                <div class="icon">
                                    <i data-feather="download"></i>
                                </div>
                                <div class="content">
                                    <p>Download completed</p>
                                    <p class="sub-text text-muted">6 hrs ago</p>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer d-flex align-items-center justify-content-center">
                            <a href="javascript:;">View all</a>
                        </div>
                    </div>
                </li>
                {{-- notifikasi --}}

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
                                <p class="email text-muted mb-3">disini untuk tempat role</p>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <ul class="profile-nav p-0 pt-2">
                                <li class="nav-item">
                                    <button class="nav-link dropdown-item btn-link">
                                        <a href="{{ url('/general/profile') }}" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="btn-lg nav-link dropdown-item btn-link" data-toggle="modal"
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

{{-- <form action="/logout" method="post">
    @csrf
    <li class="nav-item">
        <button type="submit" class="nav-link dropdown-item btn-link" data-toggle="modal" data-target="#exampleModal">
            <a href="/logout" class="nav-link">
                <i data-feather="log-out"></i>
                <span>Logout</span>
            </a>
        </button>
    </li>
</form> --}}


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
