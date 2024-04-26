<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>User List</h1>

    <!-- Existing User List -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Serial Number</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Branch</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @if($user->is_admin == 0)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->branch }}</td>
                        <td><a href="{{ route('payments.index', ['id' => $user->id]) }}">Payment</a></td>
                        <td><a href="{{ route('user.delete', ['id' => $user->id]) }}">Delete</a></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <hr>

    <!-- Branches Section -->
    <h2>Branches</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Branch ID</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($br as $branch)
                <tr>
                    <td>{{ $branch->id }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->address }}</td>
                    <td>
                        <form action="{{ route('branch.delete', ['id' => $branch->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <!-- Add Branch Form -->
    <h2>Add Branch</h2>
    <form action="{{ route('branch.create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="branch_name" class="form-label">Branch Name</label>
            <input type="text" class="form-control" id="branch_name" name="branch_name" required>
        </div>
        <div class="mb-3">
            <label for="branch_address" class="form-label">Branch Address</label>
            <input type="text" class="form-control" id="branch_address" name="branch_address" required>
        </div>
        <button type="submit" class="btn btn-success">Add Branch</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
