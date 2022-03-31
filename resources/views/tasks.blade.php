<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Laravel File Upload</title>
    <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <form action="<?php echo url('user/store');?>"  method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5">ADD task</h3>
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="title" placeholder="Enter title"  width="100px" height="200px" value="<?php echo old('title');?>">
        </div>


        <div class="form-group">
            <label >content</label>
            <textarea  class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="enter message" width="300px" height="200px" value="<?php echo old('content');?>"></textarea>
        </div>
        <div class="custom-file">
            <label >start Date</label>
            <input type="date" class="form-control"  id="exampleInputName" aria-describedby="" name="start_date" placeholder="Enter title"  width="100px" height="200px" value="<?php echo old('title');?>">

            </div>
            <div class="custom-file">
            <label >expire Date</label>
            <input type="date" class="form-control"  id="exampleInputName" aria-describedby="" name="end_date" placeholder="Enter title"  width="100px" height="200px" value="<?php echo old('title');?>">

            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
               SAVE
            </button>
        </form>
        <lable>image search</search>
        <input type="file" name="image"><a href="<?php echo url('search');?>" class="btn btn_danger"> search </a>
    </div>
</body>
</html>

