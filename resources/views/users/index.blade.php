<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">User Form</h2>
        <form id="userForm" class="p-4 border rounded bg-light" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail2">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail2" placeholder="Enter Email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Phone</label>
                    <input type="text" class="form-control" name="phone" id="exampleInputEmail3" placeholder="Enter Phone" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail4">Description</label>
                    <textarea name="description" class="form-control" id="exampleInputEmail4" placeholder="Enter Description"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="role">Role</label>
                    <select name="role_id" class="form-control" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="profileImage">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control-file" id="profileImage">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>

        <h3 class="text-center mt-5">User List</h3>
        <div class="table-responsive">
            <table id="userTable" class="table table-bordered table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Description</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <script>

        $(document).ready(function() {
            // Fetch all users on page load
            fetchUsers();


            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Handle form submission with AJAX
            $('#userForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '{{route("users.store")}}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.errors) {
                            alert(response.errors);
                        } else {
                            fetchUsers();  // Refresh the user list
                            alert(response.success);
                        }
                    }
                });
            });

            // Function to fetch and display all users
            function fetchUsers() {
                $.ajax({
                    url: '{{route("users.list")}}',
                    type: 'GET',
                    success: function(users) {
                        $('#userTable tbody').empty();
                        users.forEach(function(user) {
                            $('#userTable tbody').append(`
                                <tr>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone}</td>
                                    <td>${user.description}</td>
                                    <td>${user.role.name}</td>
                                    <td><img src="{{ asset('storage') }}/${user.profile_image}" alt="Profile Image" width="50"></td>
                                </tr>
                            `);
                        });
                    }
                });
            }
        });

    </script>
</body>
</html>
