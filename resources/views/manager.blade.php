@extends('layout')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $x }}</h1>

        <h2>List of Users:</h2>
        @foreach($users as $user)
            @if($user->branch == $x)
                <div class="card user-card">
                    <div class="card-body">
                        <h5 class="card-title">User: {{ $user->name }}</h5>
                        <p class="card-text">Email: {{ $user->email }}</p>
                        <!-- Add more user details as needed -->

                        <!-- Payment Form -->
                        <form action="{{ route('payments.store') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="mb-1">
                                <input type="text" class="form-control" placeholder="Month" name="month">
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control" placeholder="Year" name="year">
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control" placeholder="Paid" name="paid">
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control" placeholder="Amount" name="amount">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </form>

                        <!-- Delete User Form -->
                        <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deleteUser({{ $user->id }})" class="btn btn-danger btn-sm mx-2">Delete</button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('deleteForm' + userId).submit();
            }
        }
    </script>
@endsection  

