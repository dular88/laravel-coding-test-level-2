@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Tasks:-</h1>
        <div class="row justify-content-center">
            <div class="col-md-8" id="form">
                <div class="card">
                    <div class="card-header">{{ __('Create Task') }}</div>
                    <div class="card-body">
                        <form id="userForm">
                            <input type="hidden" name="fstatus" id="fstatus" value="add" />
                            <input type="hidden" name="tid" id="tid" value="" />
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input type="text" id="title" class="form-control" name="title"
                                        autocomplete="title" autofocus></textarea>
                                    <span class="invalid-feedback" role="alert" id="titleError">
                                        <strong>Title is required !!!</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" autocomplete="description" autofocus></textarea>
                                    <span class="invalid-feedback" role="alert" id="descriptionError">
                                        <strong>Description is required !!!</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Task Status') }}</label>

                                <div class="col-md-6">
                                    <select id="status" class="form-control" name="status">
                                        <option value="NOT_STARTED">NOT_STARTED</option>
                                        <option value="IN_PROGRESS">IN_PROGRESS</option>
                                        <option value="READY_FOR_TEST">READY_FOR_TEST</option>
                                        <option value="COMPLETED">COMPLETED</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="statusError">
                                        <strong>Status is required !!!</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary" onclick="saveTask();" id="submitButton">
                                        {{ __('Add Task') }}
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Project</th>
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
            $("#form").hide();
            $(".invalid-feedback").hide();
            $("#message").hide();
            getAlltasks();
        });

        function getAlltasks() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            $.ajax({
                url: "/api/v1/taskByUser?id={{ Auth::user()->id }}",
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
                        tbody = tbody + "<tr><td>" + i + "</td><td>" + value.title + "</td><td>" + value
                            .description + "</td><td>" + value.status + "</td><td>" + value.project
                            .name + "</td><td><button type='button' onclick='editTask(" + value.id +
                            ")' class='btn btn-primary'>Edit</button></td></tr>";
                        i++;
                    });
                    $("tbody").append(tbody);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Something went wrong');
                }
            });
        }


        function saveTask() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $("#userForm").serialize() + "&userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';

            var title1 = false;
            var description1 = false;


            var tid = $("#tid").val();


            var title = $("#title").val();
            if (title == "") {
                $("#title").focus();
                $("#titleError").show();
                title1 = false;
            } else {
                title1 = true;
                $("#titleError").hide();
            }

            var description = $("#description").val();
            if (description == "") {
                $("#description").focus();
                $("#descriptionError").show();
                description1 = false;
            } else {
                description1 = true;
                $("#descriptionError").hide();
            }



            if (title1 == true && description1 == true) {
                $.ajax({
                    url: "/api/v1/tasks/" + tid,
                    method: "PUT",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {
                        $("#fstatus").val('add');
                        $("#submitButton").html('Add Task');
                        getAlltasks();
                        $("#message").show();
                        $("#msg").text('Task Updated Successfully ');
                        setTimeout(function() {
                            $("#message").hide();
                            $("#form").hide();

                        }, 5000);
                        $('#userForm')[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Something went wrong');
                    }
                });
            }
        }

        function editTask(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            $.ajax({
                url: "/api/v1/tasks/" + id,
                method: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Authorization': 'Bearer ' + token
                },
                data: formData,
                success: function(response) {
                    $("#form").show();
                    $("#fstatus").val('edit');
                    $("#submitButton").html('Update Task');
                    $("#tid").val(
                        response.id);
                    $("#title").val(response.title);
                    $("#description").val(response
                        .description);
                    $("#status").val(response.status);
                    $("#project_id").val(response
                        .project_id);
                    $("#user_id").val(response.user_id);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Something went wrong');
                }
            });

        }

        function deleteTask(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = "userRole=" + '{{ Auth::user()->role }}';
            var token = '{{ session('sanctum_token') }}';
            var confirmed = confirm('Are Sure to Delete !!!');
            if (confirmed) {
                $.ajax({
                    url: "/api/v1/tasks/" + id,
                    method: "DELETE",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Authorization': 'Bearer ' + token
                    },
                    data: formData,
                    success: function(response) {
                        getAlltasks();
                        $("#message").show();
                        $("#msg").text('Task Deleted Successfully');
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
