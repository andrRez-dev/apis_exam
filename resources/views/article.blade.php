<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <h1 class="ms-2">Edit Article</h1>
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

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row m-2">
                <label class="col-2 col-form-label" for="author_id">Author</label>
                <div class="col-5">
                    <input class="form-control" list="authors_list" id="author_id" name="author_id" placeholder="Author Id" value="{{ $article->author_id }}">
                    <datalist id="authors_list">
                        @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->first_name}}, {{ $author->last_name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>

            <div class="row m-2">
                <label class="col-2 col-form-label">Title</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="title" placeholder="Title" autocomplete="off" value="{{ $article->title }}" required>
                </div>
            </div>

            <div class="row m-2">
                <label class="col-2 col-form-label">Description</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="description" placeholder="Description" value="{{ $article->description }}" autocomplete="off" required>
                </div>
            </div>
        <div class="m-3 mt-4">
            <button type="button" class="btn btn-danger" onclick="window.location.href='/articles';">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
    </form>
    </div>
    
</div>

</body>
</html>