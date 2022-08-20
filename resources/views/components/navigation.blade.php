<!-- koga ke e url - profile, togas menuto, inaku samo slika -->
<header class="p-3 mb-3 border-orange border-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="#" class="fw-bold fs-5 text-decoration-none"><span class="text-black">BRAINSTER</span><span class="text-gray">PRENEURS</span></a>
            </a>

            <!-- if route == link, then link-seconday ? link-dark -->

            @if (Auth::user()->completed)
            <ul class="nav col-12 col-lg-auto ms-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link mx-1 fw-semibold link-secondary">My Projects</a></li>
                <li><a href="#" class="nav-link mx-1 fw-semibold link-dark">My Applications</a></li>
                <li><a href="#" class="nav-link mx-1 fw-semibold link-dark">My Profile</a></li>
            </ul>
            @endif
            
            <div class="dropdown text-end @if (!Auth::user()->completed) ms-lg-auto @endif">
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