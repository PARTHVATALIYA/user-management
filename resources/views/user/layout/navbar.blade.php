<nav>
    <ul>
        <div class="d-flex">
            <a class="logo" href="#"><img src="http://localhost/practice/userManagement/public/assets/image/logo.png" alt=""></a>
            <div class="d-flex align-items-center">
                <li class="d-flex align-items-center"><a href="">Dashboard</a></li>    
                <li><a class="profile" href="{{route('user.profile')}}">Profile</a></li>
            </div>
        </div>
        <div class="mt-2 mb-2 d-flex align-items-center">
            <li><span class="image"></span></li>
            <li class="d-flex justify-content-center signoutButton">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-1 mb-1 me-2 signout">
                        <img class="signout" src="{{ asset('assets/image/shutdown.png') }}" alt="Sign out" style="vertical-align: middle;">
                        <span class="text-light ms-2">Sign out</span>
                    </button>
                </form>
            </li>
        </div>
    </ul>
</nav>