@extends('layout')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-3">Payment Records</h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->month }}</td>
                            <td>{{ $payment->year }}</td>
                            <td>{{ $payment->paid ? 'Paid' : 'Unpaid' }}</td>
                            <td>
                                <form method="POST" action="{{ route('payments.update', $payment->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="paid" value="1" {{ $payment->paid ? 'checked' : '' }}>
                                        <label class="form-check-label">Mark as Paid</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
