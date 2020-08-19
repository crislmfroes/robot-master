<div>
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete State</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the {{ $item->name }} State?</p>
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
            Outcomes
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($item->outcomes as $outcome)
            <li class="list-group-item">{{ $outcome->name }}</li>
            @endforeach
        </ul>
        <div class="card-body">
            Robot: {{ $item->robot->name }}
        </div>
        <div class="card-body">
            <a href="{{ route($edit_route, [$item->robot, $item]) }}" class="btn btn-primary">Edit</a>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete-modal">Delete</button>
        </div>
    </div>
</div>
