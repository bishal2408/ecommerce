<div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('merchant.category.update', ['category'=>$category->id ]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name" class=" font-weight-bold">Category</label>
                <input required type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" placeholder="Enter category type">
            </div>
            <input type="submit" value="Update Category" class="btn btn-primary btn-md">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
        </form>
        </div>
      </div>
    </div>
</div>