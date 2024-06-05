<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('pos.index', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
        ]);

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'discount' => $request->discount ?? 0,
            'total' => 0, // We'll calculate this in a moment
        ]);

        $total = 0;

        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $price = $product->sell_price;

            $total += $price * $quantity;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        $total -= $invoice->discount;
        $invoice->update(['total' => $total]);

        return redirect()->route('pos.invoices');
    }

    public function invoices()
    {
        $invoices = Invoice::with('customer')->get();
        return view('pos.invoices', compact('invoices'));
    }
}

