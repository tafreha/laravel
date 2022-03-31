<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Login</h2>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        {{  session()->get('Message')    }}

        <form action="{{ url('DoLogin') }}" method="post" enctype="multipart/form-data">


            @csrf

            <div class="form-group">
                <label for="exampleInputEmail">Email </label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email" placeholder="Enter email" value="<?php echo old('email'); ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword"> Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                    placeholder="Password">
            </div>


            <button type="submit" class="btn btn-primary">GO !!</button>  <a href="{{url('user/create')}}"  class='btn btn-danger m-r-1em'>register</a>
        </form>
    </div>


</body>

</html>
