@extends('layout')

@section('content')

<div class="container py-4">
    <h2 class="mb-4 text-center">Sales Dashboard</h2>

   
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Sales (7 Days)</h5>
                    <h3>{{ number_format($totalSales, 2) }} Tsh</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3 mt-md-0">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Quantity Sold</h5>
                    <h3>{{ $totalQuantity }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3 mt-md-0">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Transactions</h5>
                    <h3>{{ $totalTransactions }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Sales Table --}}
    <div class="card">
        <div class="card-header">Recent Sales (Last 7 Days)</div>
        <div class="card-body p-0">
            @if($sales->count())
                <table class="table table-striped mb-0">
                    <thead class="table-light">
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
                <p class="p-3 text-muted">No recent sales found.</p>
            @endif
        </div>
    </div>
</div>

@endsection
