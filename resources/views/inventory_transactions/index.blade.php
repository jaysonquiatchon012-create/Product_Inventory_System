<!DOCTYPE html>
<html>
<head>
    <title>Inventory History - Product Inventory</title>
</head>
<body>

    <h1>Inventory History</h1>

    <form action="{{ route('inventory-transactions.index') }}" method="GET">

        <input
            type="text"
            name="search"
            placeholder="Search by Product Code or Name"
            value="{{ $search ?? '' }}"
        >

        <select name="type">
            <option value="">All Transactions</option>

            <option value="in" {{ ($type ?? '') === 'in' ? 'selected' : '' }}>
                Stock In
            </option>

            <option value="out" {{ ($type ?? '') === 'out' ? 'selected' : '' }}>
                Stock Out
            </option>
        </select>

        <button type="submit">Search</button>

    </form>

    <br>

    <table border="1" cellpadding="8">

        <tr>
            <th>Product</th>
            <th>Transaction Type</th>
            <th>Quantity</th>
            <th>Stock Before</th>
            <th>Stock After</th>
            <th>Reason / Reference</th>
            <th>Date</th>
            <th>User</th>
        </tr>

        @foreach ($transactions as $transaction)

            <tr>

                <td>
                    {{ $transaction->product->name }}
                </td>

                <td>
                    @if ($transaction->type === 'in')
                        Stock In
                    @else
                        Stock Out
                    @endif
                </td>

                <td>
                    {{ $transaction->quantity }}
                </td>

                <td>
                    {{ $transaction->stock_before }}
                </td>

                <td>
                    {{ $transaction->stock_after }}
                </td>

                <td>
                    {{ $transaction->reason ?? 'N/A' }}
                </td>

                <td>
                    {{ $transaction->transaction_date->format('M d, Y h:i A') }}
                </td>

                <td>
                    {{ $transaction->user->name ?? 'System' }}
                </td>

            </tr>

        @endforeach

    </table>

    <br>

        {{ $transactions->links() }}

    <br>

    <br>

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>