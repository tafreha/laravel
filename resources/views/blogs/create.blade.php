<?php
use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>{{ $title }}</h2>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <form action="{{url('/Blog')}}" method="post" enctype="multipart/form-data">


             @csrf

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title"
                    placeholder="Enter Title"   value="{{old('title')}}" >
            </div>




            <div class="form-group">
                <label for="exampleInputPassword"> Content</label>
                <textarea class="form-control" id="exampleInputPassword1" name="content">  {{old('content')}}  </textarea>
            </div>

            <div class="custom-file">
                <label >start Date</label>
                <input type="date" class="form-control"  id="exampleInputName"  aria-describedby="" name="start_date" placeholder="Enter title"  width="100px" height="200px" value="<?php  Carbon::today()->format('d/m/Y');;?>">

                </div>
                <div class="custom-file">
                <label >expire Date</label>
                <input type="date" class="form-control"  id="exampleInputName" aria-describedby="" name="end_date" placeholder="Enter title"  width="100px" height="200px" value="<?php echo old('title');?>">

                </div>

            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>


</body>

</html>
