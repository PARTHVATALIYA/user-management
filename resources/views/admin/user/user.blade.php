<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/admin/navbar.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/admin/sidebar.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/admin/users.css')}}">
    </head>
    <body>
        @include('admin/layout/navbar')
        @include('admin/layout/sidebar')
        <table class="table" id="table">
            <thead>
                <!-- <th>Profile</th> -->
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone number</th>
                <th>Grade</th>
                <th>Hobby</th>
                <th>Status</th>
                <th>Mail verified?</th>
                <th>Is approved?</th>
                <th>Action</th>
            </thead>
            <tbody class="allUserList">
                @foreach( $users as $user)
                <tr class="userRow">
                    <td class="userData userName">{{ $user->first_name . ' ' . $user->last_name}}</td>
                    <td class="userData email">{{ $user->email}}</td>
                    <td class="userData gender">{{ $user->gender}}</td>
                    <td class="userData phone_number">{{ $user->phone_number}}</td>
                    <td class="userData grade">{{ $user->grade}}</td>
                    <td class="userData hobby">{{ $user->hobby}}</td>
                    <td class="userData status">
                        <div class="toggle {{'active' === $user->status ? 'active' : 'deActive' }}" id="{{'toggle_' . $user->id}}"><div class="toggleButton" id="{{'toggle_' . $user->id}}"></div></div>
                    </td>
                    <td class="userData is_verified">
                        @if ($user->is_verified)
                            &#x2705;
                        @else
                            &#x274C;
                        @endif
                        </td>
                    <td class="userData is_approved">
                        @if ($user->is_approved)
                            Approved
                        @else
                            <button class="btn approveUserButton" id="{{ 'approve_' . $user->id}}">Approve</button>
                        @endif
                    </td>
                    <td class="actionOnUserData dropdown">
                        <button class="actionButton">Action</button>
                        <div class="dropdownButtons">
                            <button class="btn btn-danger deleteButton" id="{{'delete_' . $user->id }}">Delete</button>
                            <button class="btn btn-primary updateButton">
                                <a class="updateUser text-decoration-none text-light" id="{{'update_' . $user->id }}" href="{{route('edit.user', $user->id)}}">Update</a>
                            </button>
                            <button class="btn showButton">
                                <a class="showUser text-decoration-none text-light" id="{{'show_' . $user->id}}" href="">Show</a>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://kit.fontawesome.com/830d1515a6.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/admin/sidebar.js')}}"></script>
    <script src="{{ asset('assets/js/admin/users.js')}}"></script>
</html>