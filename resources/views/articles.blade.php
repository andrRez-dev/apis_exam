<div class="modal fade" id="ArticleModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Add Article</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('ArticleModal');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
            });
        </script>
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error) 
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="/articles" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row m-2">
                <label class="col-2 col-form-label" for="author_id">Author</label>
                <div class="col-5">
                    <input class="form-control" list="authors_list" id="author_id" name="author_id" placeholder="Author Id">
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
                    <input type="text" class="form-control" name="title" placeholder="Title" autocomplete="off" required>
                </div>
            </div>

            <div class="row m-2">
                <label class="col-2 col-form-label">Description</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="description" placeholder="Description" autocomplete="off" required>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@include('layouts.app')

<h1 class="text-center">Articles</h1>
    <div class="mt-2 ms-4">
        <div class="d-flex justify-content-between align-items-center mb-3" style="width: 79%;">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ArticleModal">Add Article</button>
            
            <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center">
                <select name="author_filter" class="form-select me-2" style="width: 250px;" onchange="this.form.submit()">
                    <option value="">All Authors</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author_filter') == $author->id ? 'selected' : '' }}>
                            {{ $author->first_name }} {{ $author->last_name }}
                        </option>
                    @endforeach
                </select>
                @if(request('author_filter'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>
        
        <table class="table table-hover text-center border border-light border-4" style="width: 79%;">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date created</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->description }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->author ? $article->author->first_name . ' ' . $article->author->last_name : $article->author_id }}</td>
                    <td class="d-flex" style="height: 50px;">
                        <a class="me-1 btn btn-warning" href="/articles/{{$article->id}}/edit"><i class="fa-solid fa-pen"></i>Edit</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">No articles found for this author.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot class="table-primary">
                <tr>
                    <td colspan="10"></td>
                </tr>
            </tfoot>
        </table>
    </div>