<div class="modal fade" id="AuthorModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Add Author</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('AuthorModal');
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
        
        <form action="/authors" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row m-2">
                <label class="col-2 col-form-label">First Name</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="first_name" placeholder="Name" autocomplete="off" required>
                </div>
            </div>

            <div class="row m-2">
                <label class="col-2 col-form-label">Last Name</label>
                <div class="col-5">
                    <input type="text" class="form-control" name="last_name" placeholder="Surname" autocomplete="off" required>
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

<h1 class="text-center">Authors</h1>
    <div class="mt-2 ms-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AuthorModal" alt="">Add Author</button>
        <table class="table table-hover text-center border border-light border-4" style="width: 79%;">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->first_name }}</td>
                    <td>{{ $author->last_name }}</td>
                    <td class="d-flex" style="height: 50px;">
                        <a class="me-1 btn btn-warning" href="/authors/{{$author->id}}/edit"><i class="fa-solid fa-pen"></i>Edit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-primary">
                <tr>
                    <td colspan="10"></td>
                </tr>
            </tfoot>
        </table>

    </div>