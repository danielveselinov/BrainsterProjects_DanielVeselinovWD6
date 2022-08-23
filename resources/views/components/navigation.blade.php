<header class="p-3 mb-3 border-orange border-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('dashboard') }}" class="fw-bold fs-5 text-decoration-none"><span class="text-black">BRAINSTER</span><span class="text-gray">PRENEURS</span></a>
            </a>

            <ul class="nav col-12 col-lg-auto ms-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('projects.index') }}" class="nav-link me-1 fw-semibold {{ (request()->routeIs('projects.index')) ? 'link-secondary' : 'link-dark' }}">My Projects</a></li>
                <li><a href="{{ route('applications.index') }}" class="nav-link me-1 fw-semibold {{ (request()->routeIs('applications.index')) ? 'link-secondary' : 'link-dark' }}">My Applications</a></li>
                <li><a href="{{ route('profile.index') }}" class="nav-link me-1 fw-semibold {{ (request()->routeIs('profile.index')) ? 'link-secondary' : 'link-dark' }}">My Profile</a></li>
            </ul>
            
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->setAvatar() }}" alt="{{ Auth::user()->name . ' ' . Auth::user()->surname }}" width="35" height="35" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            >Log out</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>