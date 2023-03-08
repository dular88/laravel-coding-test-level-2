@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Project') }}</div>

                    <div class="card-body">
                        <form id="userForm">
                            <input type="hidden" name="fstatus" id="fstatus" value="add" />
                            <input type="hidden" name="pid" id="pid" value="" />
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                        autocomplete="name" autofocus>
                                    <span class="invalid-feedback" role="alert" id="nameError">
                                        <strong>name is required !!!</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary" onclick="saveProject();"
                                        id="submitButton">
                                        {{ __('Add Project') }}
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
            getAllProjects();
        });

        function getAllProjects() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            $.ajax({
                url: "/api/v1/projects",
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
                        tbody = tbody + "<tr><td>" + i + "</td><td>" + value.name +
                            "</td><td><button type='button' onclick='editProject(" + value.id +
                            ")' class='btn btn-primary'>Edit</button>&nbsp;<button type='button' onclick='deleteProject(" +
                            value.id +
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


        function saveProject() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $("#userForm").serialize() + "&userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';

            var name1 = false;
            var apiUrl = "/api/v1/projects";
            var apiMethod = "POST";

            var fstatus = $("#fstatus").val();
            var pid = $("#pid").val();
            if (fstatus == 'edit') {
                apiUrl = "/api/v1/projects/" + pid;
                apiMethod = "PUT";
            }

            var name = $("#name").val();
            if (name == "") {
                $("#name").focus();
                $("#nameError").show();
                name1 = false;
            } else {
                name1 = true;
                $("#nameError").hide();
            }

            if (name1 == true) {
                $.ajax({
                    url: apiUrl,
                    method: apiMethod,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {
                        $("#fstatus").val('add');
                        $("#submitButton").html('Add Project');
                        getAllProjects();
                        $("#message").show();
                        $("#msg").text('Project Saved Successfully ');
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

        function editProject(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            $.ajax({
                url: "/api/v1/projects/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Authorization': 'Bearer ' + token
                },
                data: formData,
                success: function(response) {
                    $("#fstatus").val('edit');
                    $("#submitButton").html('Update Project');
                    $("#pid").val(response.id);
                    $("#name").val(response.name);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Something went wrong');
                    console.log("API call failed:", errorThrown);
                }
            });

        }

        function deleteProject(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            var confirmed = confirm('Are Sure to Delete !!!');
            if (confirmed) {
                $.ajax({
                    url: "/api/v1/projects/" + id,
                    method: "DELETE",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {
                        getAllProjects();
                        $("#message").show();
                        $("#msg").text('Project Deleted Successfully');
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
    </script>
@endsection
