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
        <a href="{{ route($edit_route, [$item->robot, $item]) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route($destroy_route, [$item->robot, $item]) }}" class="btn btn-danger">Delete</a>
    </div>
</div>
