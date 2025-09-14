<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; margin: 0; padding: 20px; }
        h1, h2, h3, h4, h5 { margin: 0; padding: 0; }
        h1 { font-size: 24px; margin-bottom: 10px; }
        h2 { font-size: 20px; margin-bottom: 8px; }
        h3 { font-size: 16px; margin-bottom: 6px; }
        .text-right { text-align: right; }
        .mt-2 { margin-top: 10px; }
        .mt-4 { margin-top: 20px; }
        .mb-2 { margin-bottom: 10px; }
        .mb-4 { margin-bottom: 20px; }
        .border { border: 1px solid #ccc; border-collapse: collapse; }
        .border th, .border td { border: 1px solid #ccc; padding: 8px; }
        .w-full { width: 100%; }
        .font-bold { font-weight: bold; }
        .bg-gray { background-color: #f3f3f3; }
    </style>
</head>
<body>

    <h1>Invoice #{{ $invoice->invoice_number }}</h1>

    <div class="mt-4">
        <h3>Client Information</h3>
        <p>
            <strong>{{ $invoice->client->name }}</strong><br>
            {{ $invoice->client->email }}<br>
            {{ $invoice->client->phone }}
        </p>
    </div>

    <div class="mt-4">
        <h3>Invoice Details</h3>
        <p>
            <strong>Issue Date:</strong> {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}<br>
            <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}<br>
            <strong>Status:</strong> {{ ucfirst($invoice->status) }}
        </p>
    </div>

    <div class="mt-4">
        <h3>Invoice Items</h3>
        <table class="w-full border">
            <thead class="bg-gray">
                <tr>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₦{{ number_format($item->unit_price, 2) }}</td>
                    <td>₦{{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-right">
        <h3>Total Amount: ₦{{ number_format($invoice->total_amount, 2) }}</h3>
    </div>

</body>
</html>
