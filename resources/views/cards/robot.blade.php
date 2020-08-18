<div class="card m-6">
    <div class="card-header">{{ $item->name }}</div>
    <div class="card-body">
        <a href="{{ route($edit_route, $item) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route($destroy_route, $item) }}" class="btn btn-danger">Delete</a>
        <a href="{{ route('list_behaviors', $item) }}" class="btn btn-success">Behaviors</a>
        <a href="{{ route('list_states', $item) }}" class="btn btn-secondary">States</a>
    </div>
</div>
