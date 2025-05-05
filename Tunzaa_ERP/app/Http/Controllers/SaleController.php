<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;

class SaleController extends Controller
{

    public function index(){
        $sales = Sale::latest()->paginate(10); // paginate to make it easier to browse
        return view('sale', compact('sales'));
    }
    public function store(Request $request)
    {
        //validation of inputs
        $validated = $request->validate([
            'product' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
        ]);
            //insertion of input in database after validation
        $sale = Sale::create([
           'user_id' => session('user')->id,

            'product' => $validated['product'],
            'quantity' => $validated['quantity'],
            'amount' => $validated['amount'],
        ]);

        // Decrease inventory after sale has been made
        $product = Product::where('name', $validated['product'])->first();
        if ($product) {
            $product->stock -= $validated['quantity'];
            $product->save();
        }

        return redirect()->route('sales.index')->with('success', 'Sale recorded.');
    }


    //function to export in csv format
    public function export()
{
    $sales = Sale::all();
    $csv = "Product,Quantity,Amount,Date\n";

    foreach ($sales as $sale) {
        $csv .= "{$sale->product},{$sale->quantity},{$sale->amount},{$sale->created_at}\n";
    }

    return response($csv)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename="sales.csv"');
}

      // dashboard method

      public function ShowDashboard(){
        return view('dashboard');
      }
public function dashboard()
{
    $sales = Sale::where('created_at', '>=', Carbon::now()->subDays(7))->get();

    $totalSales = $sales->sum('amount');
    $totalQuantity = $sales->sum('quantity');
    $totalTransactions = $sales->count();

    return view('dashboard', compact('sales', 'totalSales', 'totalQuantity', 'totalTransactions'));
}


}
