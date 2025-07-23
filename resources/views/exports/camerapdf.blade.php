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
                <th>Domain</th>
                <th>Ip tĩnh</th>
                <th>Svr port</th>
                <th>Http port</th>
                <th>Rtsp port</th>
                <th>User</th>
                <th>Pass đầu ghi</th>
                <th>Pass cam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row['ID'] }}</td>
                    <td>{{ $row['Nhà hàng'] }}</td>
                    <td>{{ $row['Domain'] }}</td>
                    <td>{{ $row['Ip tĩnh'] }}</td>
                    <td>{{ $row['SVR port'] }}</td>
                    <td>{{ $row['Http port'] }}</td>
                    <td>{{ $row['Rtsp port'] }}</td>
                    <td>{{ $row['User'] }}</td>
                    <td>{{ $row['Pass'] }}</td>
                    <td>{{ $row['Passcam'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>