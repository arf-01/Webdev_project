<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-details {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Receipt</h1>
        </div>
        <div class="receipt-details">
            <p><strong>Customer Name:</strong> {{ $sale->customer_name }}</p>
            <p><strong>Customer Mobile:</strong> {{ $sale->customer_mobile }}</p>
            <p><strong>Package Code:</strong> {{ $package->description }}</p>
            <p><strong>Discounted Price:</strong> ${{ $sale->discounted_price }}</p>
        </div>
    </div>
</body>
</html>
