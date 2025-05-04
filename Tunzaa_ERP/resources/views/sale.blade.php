<!-- resources/views/sales/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-4">

    <h2 class="mb-4 text-center">Sales Tracker</h2>

    {{-- Sale Form --}}
    <div class="card mb-4">
        <div class="card-header">Record a Sale</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('sales.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="product" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Sale</button>
            </form>
        </div>
    </div>

    {{-- Sales List --}}
    <div class="card">
        <div class="card-header">Past 7 Days Sales</div>
        <div class="card-body">
            @if($sales->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Amount (Tsh)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->created_at->format('d M Y') }}</td>
                                <td>{{ $sale->product }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ number_format($sale->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No sales recorded in the last 7 days.</p>
            @endif
        </div>
    </div>

</div>
</body>
</html>
