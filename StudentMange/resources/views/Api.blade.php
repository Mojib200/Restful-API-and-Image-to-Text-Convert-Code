<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="row mx-5 mt-5 ">
        <div class="col-sm-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter name">
            <small id="name_error" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
            <small id="email_error" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <small id="password_error" class="form-text text-muted"></small>
        </div>
    
        <button type="submit" onClick="addUser()" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-6">
            <table>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                @foreach ($user as $user)
                <tr>
                    <td>
                    {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                  
                    <td>
                        <input type="button" class="edit" value="edit" onclick="">
                        <input type="button" id="delete_id" class="delete" value="delete" onclick="deleteById({{$user->id}})">
                        {{-- <button type="submit" onClick="editUser()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                          </svg></i></button>
 
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                      </svg></a> --}}
                    </td>
                </tr>
                @endforeach
                
            </table>
        </div>
    </div>
    <div class="row col-sm-6 ">
       

    </div>

    <script>
        function addUser() {
            const formdata = new FormData();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            formdata.append("name", name);
            formdata.append("email", email);
            formdata.append("password", password);

            const requestOptions = {
                method: "POST",
                body: formdata,
                redirect: "follow"
            };

            fetch("http://127.0.0.1:8000/api/add-user", requestOptions)
                .then((response) => response.text())
                .then((result) => {

                        console.log(JSON.parse(result))
                        result = JSON.parse(result);

                        if (result.data && result.data.name) {
                            document.getElementById('name_error').innerText = result.data.name[0];
                        }
                        if (result.data && result.data.email) {
                            document.getElementById('email_error').innerText = result.data.email[0];
                        }
                        if (result.data && result.data.password) {
                            document.getElementById('password').innerText = result.data.password[0];
                        }
                        if (result.success) {
                            alert(result.success);
                        }
                    }

                )
                .catch((error) => console.error(error));
        }
        // function deleteById(){document.getElementById('delete_id').outerHTML="";
            
        // }
        function getAllUser(){
            
        }
    </script>
</body>

</html>
