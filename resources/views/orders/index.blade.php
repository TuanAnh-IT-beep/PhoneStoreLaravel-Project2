
<h3>Order List</h3>
<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Ship code</th>
        <th>Customer</th>
        <th>Receiver</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Note</th>
        <th>Payment</th>
        <th>Ship fee</th>
        <th>Total price</th>
        <th>Status</th>
    </tr>
    @foreach ($orders as $ord)
        <tr>
            <td>
                {{ $ord->id }}
            </td>
            <td>
                {{ $ord->ship_track_id}}
            </td>
            <td>
                {{ $ord->customer->username}}
            </td>
            <td>
                {{ $ord->receiver }}
            </td>
            <td>
                {{ $ord->address }}
            </td>
            <td>
                {{ $ord->phone }}
            </td>
            <td>
                {{ $ord->note }}
            </td>
            <td>
                {{ $ord->payment->name }}
            </td>
            <td>
                {{ $ord->ship_fee }}
            </td>
            <td>
                {{ $ord->total_price }}
            </td>
            <td>
                {{ $ord->status }}
            </td>
            <td>
                <a href="{{ route('orders.edit', $ord->id) }}">Edit</a>
                <form method="post" action="{{ route('orders.destroy', $ord->id) }}">
                    @csrf
                    @method('DELETE')
                    <button>Cancel</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>