<nav class="navbar">
    <ul>
        <li class="ms-2">
            <span class="navbar-toggler-icon openSidebar"></span>
            <span class="navbar-toggler-icon closeSidebar"></span>
            <a class="logo" href="#"><img src="{{ asset('assets/image/logo.png') }}" alt=""></a>
        </li>

        <div class="d-flex">
            <li class="profile"><img class="image"  src=""></li>
            <li >
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-1 mb-1 me-2">
                        <img class="signout" src="{{ asset('assets/image/shutdown.png') }}" alt="Sign out" style="vertical-align: middle;">
                        <span class="text-light ms-2">Sign out</span>
                    </button>
                </form>
            </li>
        </div>
    </ul>
</nav>