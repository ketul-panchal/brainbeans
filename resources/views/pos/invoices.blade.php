@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoices</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->customer->name }}</td>
                <td>{{ $invoice->discount }}</td>
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
