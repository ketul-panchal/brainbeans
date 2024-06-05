@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Point of Sale</h1>
    <form action="{{ route('pos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control mb-3" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_search">Product Search</label>
            <input type="text" id="product_search" class="form-control mb-3" placeholder="Search for a product...">
            <ul id="product_list" class="list-group mt-2" style="display: none;">
                <!-- Dynamic product list -->
            </ul>
        </div>
        <div class="form-group">
            <label for="products">Selected Products</label>
            <table class="table" id="products_table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Products will be dynamically added here -->
                </tbody>
            </table>
        </div>
        <div class="form-group mb-3">
            <label for="discount">Discount</label>
            <input type="number" name="discount" id="discount" class="form-control" min="0" step="0.01">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
<script>
    const products = @json($products);
    const productsTable = document.getElementById('products_table').querySelector('tbody');
    const productSearch = document.getElementById('product_search');
    const productList = document.getElementById('product_list');

    productSearch.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const matchingProducts = products.filter(product => product.name.toLowerCase().includes(query));
        
        productList.innerHTML = '';
        if (matchingProducts.length > 0) {
            productList.style.display = 'block';
            matchingProducts.forEach(product => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.textContent = product.name;
                listItem.setAttribute('data-product-id', product.id);
                listItem.addEventListener('click', function() {
                    addProductToTable(product.id);
                    productList.style.display = 'none';
                });
                productList.appendChild(listItem);
            });
        } else {
            productList.style.display = 'none';
        }
    });

    function addProductToTable(productId) {
        const product = products.find(product => product.id == productId);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.name}</td>
            <td><input type="number" name="products[${productId}][quantity]" value="1" min="1" class="form-control"></td>
            <td>${product.sell_price}</td>
            <td><button type="button" class="btn btn-danger" onclick="removeProductFromTable(this)">Remove</button></td>
            <input type="hidden" name="products[${productId}][id]" value="${productId}">
        `;
        productsTable.appendChild(row);
    }

    function removeProductFromTable(button) {
        button.closest('tr').remove();
    }
</script>
@endsection
