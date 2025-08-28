<!DOCTYPE html>
<html>

<head>
    <title>Trial Balance</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: right;
        }

        th {
            background: #ccc;
        }

        td.text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <h3>Trial Balance Report</h3>
    <p>Period: {{ $start_date }} to {{ $end_date }}</p>
    <table>
        <thead>
            <tr>
                <th>Account Code</th>
                <th>Account Name</th>
                <th>Opening Balance</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Closing Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td class="text-left">{{ $row['account_code'] }}</td>
                <td class="text-left">{{ $row['account_name'] }}</td>
                <td>{{ number_format($row['opening_balance'], 2) }}</td>
                <td>{{ number_format($row['debit'], 2) }}</td>
                <td>{{ number_format($row['credit'], 2) }}</td>
                <td>{{ number_format($row['closing_balance'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
