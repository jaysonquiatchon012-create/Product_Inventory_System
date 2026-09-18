<!DOCTYPE html>
<html>
<head>
    <title>Product Inventory</title>
    <style>
        nav svg {
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>

    <h1>Product Inventory</h1>

    <div>
        <div>
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>

        <div>
            <h3>Total Categories</h3>
            <p>{{ $totalCategories }}</p>
        </div>

        <div>
            <h3>Total Stock</h3>
            <p>{{ $totalStock }}</p>
        </div>
    </div>

    <br>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if ($lowStockProducts->count() > 0)
        <div style="border: 1px solid orange; padding: 10px; margin-bottom: 20px;">

            <h3 style="color: orange;">
                Low Stock Alert
            </h3>

            <ul>
                @foreach ($lowStockProducts as $lowStockProduct)
                    <li>
                        <strong>{{ $lowStockProduct->name }}</strong>
                        — Stock: {{ $lowStockProduct->quantity }}
                        — Minimum: {{ $lowStockProduct->minimum_stock }}
                    </li>
                @endforeach
            </ul>

        </div>
    @endif

    <a href="{{ route('products.create') }}">Add Product</a>

    <a href="{{ route('inventory-transactions.create') }}">
        Stock In / Stock Out
    </a>

    <a href="{{ route('inventory-transactions.index') }}">
        Inventory History
    </a>

    <br>

    <a href="{{ route('reports.index') }}">
        Reports
    </a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf

        <button type="submit">Logout</button>
    </form>

    <br><br>

    <input
        type="text"
        id="searchInput"
        placeholder="Search by Product Code or Name"
        value="{{ $search ?? '' }}"
    >

    <br><br>

    <label for="categoryFilter">Category:</label>

    <select id="categoryFilter">
        <option value="">All Categories</option>

        @foreach ($categories as $categoryItem)
            <option value="{{ $categoryItem->id }}"
                {{ ($category ?? '') == $categoryItem->id ? 'selected' : '' }}>
                {{ $categoryItem->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Product Code</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Minimum Stock</th>
            <th>Category</th>
            <th>Stock Status</th>
            <th>Supplier</th>
            <th>Action</th>
        </tr>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->product_code }}</td>
                <td>{{ $product->name }}</td>
                <td>₱{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->minimum_stock }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->stockStatus }}</td>

                <td>
                    @foreach ($product->suppliers as $supplier)
                        {{ $supplier->name }}
                    @endforeach
                </td>


                <td>
                    <a href="{{ route('products.show', $product->id) }}">
                            View
                        </a>
                        &nbsp;

                        <a href="{{ route('products.edit', $product->id) }}">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

    <br>

        {{ $products->links() }}

    <script>
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');

        function filterProducts() {
            const search = searchInput.value;
            const category = categoryFilter.value;

            fetch(
                "{{ route('products.index') }}?search="
                + encodeURIComponent(search)
                + "&category="
                + encodeURIComponent(category)
            )
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const html = parser.parseFromString(data, 'text/html');

                    const newTable = html.querySelector('table');
                    const currentTable = document.querySelector('table');

                    if (newTable && currentTable) {
                        currentTable.innerHTML = newTable.innerHTML;
                    }
                });
        }

        searchInput.addEventListener('input', filterProducts);
        categoryFilter.addEventListener('change', filterProducts);
    </script>

</body>
</html>