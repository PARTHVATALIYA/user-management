<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/admin/edit.css')}}">
    </head>
    <body>
    <div class="wrapper registrationForm" id="registrationForm">
            <div class="inner">
                <form class="d-flex justify-content-center flex-column registrationForm" id="userUpdateForm" action="{{route('edit', $user['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h3>Update</h3>
                    <div class="form-wrapper mt-2">
                        <div class="studentName mb-3 row">
                            <div class="col-lg-6 firstName">
                                <label for="firstName">Enter student first name*: </label>
                                <input class="form-control" type="text" name="first_name" id="firstname" value="{{$user['first_name']}}">
                            </div>
                            <div class="col-lg-6 lastName">
                                <label for="lastName">Enter student last name*: </label>
                                <input class="form-control" type="text" name="last_name" id="lastName"value="{{$user['last_name']}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrapper mt-2">
                        <div class="emailAndPassword mb-3 row ">
                            <div class="email col-lg-6 col-md-6 col-sm-6">
                                <label for="email">Enter email Address*: </label>
                                <input class="form-control" class="emailInput"  type="email" name="email" id="email" value="{{$user['email']}}" disabled>
                            </div>
                            <div class="col-lg-6 grade">
                                <label for="grade">Select grade: </label>
                                <select name="grades" class="grades p-2" id="grades">
                                    @foreach($grades as $grade )
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-wrapper mt-2">
                        <div class="phoneNumebrAndGender mb-3 d-flex row flex-row">
                            <div class="phoneNumber d-flex col-lg-6 col-md-6 col-sm-6 flex-column">
                                <label for="phoneNumber">Enter phone number*: </label>
                                <input class="form-control" class="phoneNumberInput"  type="number" name="phone_number" id="phoneNumber" value="{{$user['phone_number']}}">
                            </div>
                            <div class="gender d-flex col-lg-6 col-md-6 col-sm-6 flex-column">
                                <label for="gender">Select gender*: </label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type = "radio" name = "gender"  value = "Male" data-error=".genderError" {{ "Male" === $user['gender'] ? 'checked' : ''}}>
                                        <label class = "me-2" for="male">Male</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type = "radio" name = "gender"  value = "Female" data-error=".genderError" {{ "Female" === $user['gender'] ? 'checked' : ''}}>
                                        <label for="male">Female</label>
                                    </div>
                                </div>
                                <span class="genderError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-wrapper">
                        <div class="hobbyAndGrade row mb-3">
                            <div class="col-lg-6 hobby">
                                <div class="hobbyLabel">
                                    <label for="hobby">Select hobbies*: </label>
                                </div>
                                <div class="hobbyCheckbox">
                                    <input type="checkbox" id="cricket" name="hobby[]" value="cricket" {{in_array('cricket', $user['hobby'], true ) ? 'checked' : ''}}>
                                    <label for="cricket"> cricket</label><br>
                                    <input type="checkbox" id="football" name="hobby[]" value="football" {{in_array('football', $user['hobby'], true ) ? 'checked' : ''}}>
                                    <label for="football"> football</label><br>
                                    <input type="checkbox" id="basketball" name="hobby[]" value="basketball" {{in_array('basketball', $user['hobby'], true ) ? 'checked' : ''}}>
                                    <label for="basketball"> basketball</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-wrapper">
                        <div class="message mb-3">
                            <label for="message">Enter message*: </label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="3">{{$user['message']}}</textarea>
                        </div>
                    </div>
                    <div class="form-wrapper d-flex align-items-center">
                    <span class="userProfilePicture" id="userProfilePicture"></span>
                        <div class="profilePicture ms-3">
                            <input type="file" name="profilePicture" id="profilePicture" accept="image/x-png, image/jpeg, image/jpg">
                            <p>(Only .png, .jpeg, .jpg file accepted)</p>
                        </div>
                    </div>
                    <div class="submitButton d-flex justify-content-center m-2">
                        <button class="btn btn-primary submitData" id="updateData">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/830d1515a6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</html>