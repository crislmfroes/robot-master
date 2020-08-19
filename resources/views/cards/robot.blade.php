<div>
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Robot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the {{ $item->name }} Robot?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route($destroy_route, $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card m-6">
        <div class="card-header">{{ $item->name }}</div>
        <div class="card-body">
            <a href="{{ route($edit_route, $item) }}" class="btn btn-primary">Edit</a>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete-modal">Delete</button>
        </div>
    </div>
</div>
