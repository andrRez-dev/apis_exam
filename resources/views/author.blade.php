<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <h1 class="ms-2">Edit Author</h1>
<div class="d-flex justify-content-around">
    <div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error) 
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

    <form action="{{ route('authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row m-2">
                <label class="col-2 col-form-label">First Name</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="first_name" placeholder="Name" autocomplete="off" value="{{ $author->first_name}}" required>
                </div>
            </div>

            <div class="row m-2">
                <label class="col-2 col-form-label">Last Name</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="last_name" placeholder="Surname" autocomplete="off" value="{{ $author->last_name}}" required>
                </div>
            </div>
        <div class="m-3 mt-4">
            <button type="button" class="btn btn-danger" onclick="window.location.href='/authors';">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
    </form>
    </div>
    
</div>

</body>
</html>