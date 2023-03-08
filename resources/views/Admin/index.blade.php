@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Product Owner') }}</div>

                    <div class="card-body">
                        <form id="userForm">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                        autocomplete="name" autofocus>
                                    <span class="invalid-feedback" role="alert" id="nameError">
                                        <strong>name is required !!!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username"
                                        autocomplete="username" autofocus>
                                    <span class="invalid-feedback" role="alert" id="usernameError">
                                        <strong>username is required !!!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control" name="role">
                                        <option value="PRODUCT_OWNER">PRODUCT_OWNER</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="roleError">
                                        <strong>Role is required !!!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    <span class="invalid-feedback" role="alert" id="emailError">
                                        <strong>Invalid Email !!!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="new-password">
                                    <span class="invalid-feedback" role="alert" id="passwordError">
                                        <strong>Password is required !!!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    <span class="invalid-feedback" role="alert" id="password-confirmError">
                                        <strong>Password is not matching !!!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary" onclick="saveUser();">
                                        {{ __('Add Product Owner') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-0" id="message">
                                <div class="col-md-6 offset-md-4">
                                    <div class="alert alert-primary" role="alert" id="msg"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>SNo</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".invalid-feedback").hide();
            $("#message").hide();
            getAllUser();
        });

        function getAllUser() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            $.ajax({
                url: "/api/v1/users",
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Authorization': 'Bearer ' + token
                },
                data: formData,
                success: function(response) {
                    $("tbody").html("");
                    var tbody = "";
                    var i = 1;
                    $.each(response, function(key, value) {
                        tbody = tbody + "<tr><td>" + i + "</td><td>" + value.name + "</td><td>" + value
                            .role +
                            "</td><td>" + value
                            .email + "</td><td><button type='button' onclick='deleteUsers(" + value.id +
                            ")' class='btn btn-danger'>Delete</button></td></tr>";
                        i++;
                    });
                    $("tbody").append(tbody);
                    console.table(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Something went wrong');
                    console.log("API call failed:", errorThrown);
                }
            });

        }


        function saveUser() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $("#userForm").serialize() + "&userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';

            var name1 = false;
            var username1 = false;
            var email1 = false;
            var password1 = false;

            var name = $("#name").val();
            if (name == "") {
                $("#name").focus();
                $("#nameError").show();
                name1 = false;
            } else {
                name1 = true;
                $("#nameError").hide();
            }
            var username = $("#username").val();
            if (username == "") {
                $("#username").focus();
                $("#usernameError").show();
                username1 = false;
            } else {
                username1 = true;
                $("#usernameError").hide();
            }
            var email = $("#email").val();
            if (email == "") {
                $("#email").focus();
                $("#emailError").show();
                email1 = false;
            } else if (validateEmail(email)) {
                email1 = true;
                $("#emailError").hide();
            } else {
                $("#email").focus();
                $("#emailError").show();
                email1 = false;
            }
            var role = $("#role").val();
            var password = $("#password").val();
            if (password == "") {
                $("#password").focus();
                $("#passwordError").show();
                password1 = false;
            } else {
                password1 = true;
                $("#passwordError").hide();
            }
            var confirm_password = $("#password-confirm").val();
            if (confirm_password == "") {
                $("#password-confirm").focus();
                $("#password-confirmError").show();
            } else if (confirm_password != password) {
                $("#password-confirm").focus();
                $("#password-confirmError").show();
            } else {
                $("#password-confirmError").hide();
            }

            if (name1 == true && email1 == true && username1 == true && password1 == true) {
                $.ajax({
                    url: "/api/v1/users",
                    method: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {
                        getAllUser();
                        $("#message").show();
                        $("#msg").text('Successfully Product Owner Created');
                        setTimeout(function() {
                            $("#message").hide();
                        }, 5000);
                        $('#userForm')[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Something went wrong');
                    }
                });
            }
        }

        function deleteUsers(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            var confirmed = confirm('Are Sure to Delete !!!');
            if (confirmed) {
                $.ajax({
                    url: "/api/v1/users/" + id,
                    method: "DELETE",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {
                        getAllUser();
                        $("#message").show();
                        $("#msg").text('Successfully Product Owner Deleted');
                        setTimeout(function() {
                            $("#message").hide();
                        }, 5000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Something went wrong');
                        console.log("API call failed:", errorThrown);
                    }
                });
            }
        }

        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
    </script>
@endsection
