<nav class="sidebar">
    <ul>
        <li><a class="dashboard sidebarActive" href="{{ route('admin.dashboard') }}">
            <img class="dashboardIcon dashboardActive me-2" src="http://localhost/practice/userManagement/public/assets/image/dashboardActive.png" alt="">
            <img class="d-none dashboardIcon dashboardDeactive" src="http://localhost/practice/userManagement/public/assets/image/dashboardDeactive.png" alt="">
            Dashboard</a></li>
        <li><a class="users" href="{{route('users')}}"><i class="fa-solid fa-users me-3"></i>Users</a></li>
        <!-- <li><a class="notification" href="http://localhost/practice/userManagement/views/admin/notification.php"><i class="fa-regular fa-bell me-3"></i>Notifications</a></li> -->
    </ul>
</nav>