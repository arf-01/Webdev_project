@extends('layout')

@section('content')
    <div class="container mt-4"> 
        <div class="row">
    
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#user-list" class="list-group-item list-group-item-action active" data-bs-toggle="tab">User List</a>
                    <a href="#branch-list" class="list-group-item list-group-item-action" data-bs-toggle="tab">Branches</a>
                    <a href="#add-branch" class="list-group-item list-group-item-action" data-bs-toggle="tab">Add Branch</a>
                    <a href="#add-package" class="list-group-item list-group-item-action" data-bs-toggle="tab" aria-controls="add-package" aria-selected="false">Add Product</a> 
                    <a href="#revenue-calculation" class="list-group-item list-group-item-action" data-bs-toggle="tab">Revenue Calculation</a>
                </div>
            </div>
    
            <!-- Main Content -->
            <div class="col-md-9"> 
                <div class="tab-content">
                    <!-- User List -->
                    <div class="tab-pane fade show active" id="user-list">
                    <h1 class="mb-4">User List</h1>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <!-- Table Header -->
        <thead class="table-dark">
            <tr>
                <th>Serial Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody>
            @foreach($users as $user)
                @if($user->is_admin == 0)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->branch }}</td>
                        <td>
                            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

                        <!-- User list table content -->
                    </div>
    
                    <!-- Branch List -->
                    <div class="tab-pane fade" id="branch-list">
                        <h1>Branches</h1>
                        <table class="table">
                        <!-- Table Header -->
                        <thead>
                            <tr>
                                <th scope="col">Branch ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <!-- Table Body -->
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

                        <!-- Branch list table content -->
                    </div>
    
                    <!-- Add Branch Form -->
                    <div class="tab-pane fade" id="add-branch">
                        <h1>Add Branch</h1>
                        <form action="{{ route('branch.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="branch_name" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="branch_address" class="form-label">Branch Address</label>
                            <input type="text" class="form-control" id="branch_address" name="branch_address" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Branch</button>
                    </form>

                    </div>
    
                    <!-- Add Package Form -->
                    <div class="tab-pane fade" id="add-package">
    <h1 class="mb-4">Add Package</h1>
    <form action="{{ route('packages.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch</label>
            <select class="form-select vintage-select" id="branch_id" name="branch_id" required>
                <option value="">Select Branch</option>
                @foreach($br as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Original Price</label>
            <input type="number" class="form-control vintage-input" id="original_price" name="original_price" required>
        </div>
        <div class="mb-3">
            <label for="discount_percentage" class="form-label">Discount Percentage</label>
            <input type="number" class="form-control vintage-input" id="discount_percentage" name="discount_percentage" required>
        </div>
        <div class="mb-3">
            <label for="background_image" class="form-label">Background Image</label>
            <input type="file" class="form-control vintage-input" id="background_image" name="background_image">
        </div>
        <div class="mb-3">
            <label for="product_code" class="form-label">Product Code</label>
            <input type="text" class="form-control vintage-input" id="product_code" name="product_code" required>
        </div>
        <div class="mb-3">
            <label for="total_available" class="form-label">Available Quantity</label>
            <input type="number" class="form-control vintage-input" id="total_available_tickets" name="total_available" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control vintage-textarea" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success btn-vintage">Add Package</button>
    </form>
</div>

    
                    <!-- Revenue Calculation Form -->
                    <div class="tab-pane fade" id="revenue-calculation">
                        <h1>Revenue Calculation</h1>
                        <form action="{{ route('calculateRevenue') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" class="form-control" id="from_date" name="from_date" required>
        </div>
        <div class="mb-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" class="form-control" id="to_date" name="to_date" required>
        </div>
        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch (Optional)</label>
            <select class="form-select" id="branch_id" name="branch_id">
    <option value="">Select Branch</option>
    @foreach($br as $branch)
        <option value="{{ $branch->name }}">{{ $branch->name }}</option>
    @endforeach
</select>

        </div>
        <button type="submit" class="btn btn-primary">Calculate Revenue</button>
    </form>
    @if(isset($revenue))
        <div class="mt-4">
            <h3>Revenue for the selected period:</h3>
            <p>Total Revenue: {{ $revenue }}</p>
        </div>
    @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection