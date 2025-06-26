<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Font hỗ trợ tiếng Việt */
            margin: 10px;
            padding: 0;
            box-sizing: border-box;
            font-size: 10pt;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: auto; /* Tự động điều chỉnh kích thước cột */
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            word-wrap: break-word; /* Ngắt từ nếu cần */
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Ngày: {{ $date }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nhà hàng</th>
                <th>Nhà mạng</th>
                <th>Men</th>
                <th>Account</th>
                <th>Pass</th>
                <th>Địa chỉ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row['ID'] }}</td>
                    <td>{{ $row['Nhà hàng'] }}</td>
                    <td>{{ $row['Nhà mạng'] }}</td>
                    <td>{{ $row['Men'] }}</td>
                    <td>{{ $row['Account'] }}</td>
                    <td>{{ $row['Pass'] }}</td>
                    <td>{{ $row['Địa chỉ'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>