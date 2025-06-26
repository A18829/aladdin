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
                <th>Thương hiệu</th>
                <th>Nhà Thầu</th>
                <th>Ruijie</th>
                <th>Đầu cam</th>
                <th>Mắt cam</th>
                <th>Tên</th>
                <th>Địa chỉ</th>
                <th>Ip tĩnh</th>
                <th>Ip máy chủ</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row['ID'] }}</td>
                    <td>{{ $row['Thương hiệu'] }}</td>
                    <td>{{ $row['Nhà thầu'] }}</td>
                    <td>{{ $row['Ruijie'] }}</td>
                    <td>{{ $row['Đầu cam'] }}</td>
                    <td>{{ $row['Mắt cam'] }}</td>
                    <td>{{ $row['Tên'] }}</td>
                    <td>{{ $row['Địa chỉ'] }}</td>
                    <td>{{ $row['Ip tĩnh'] }}</td>
                    <td>{{ $row['Ip máy chủ'] }}</td>
                    <td>{{ $row['Trạng thái'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>