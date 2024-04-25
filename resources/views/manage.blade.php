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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

