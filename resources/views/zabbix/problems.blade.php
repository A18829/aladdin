<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zabbix Problems</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Zabbix Problems</h1>

    @if (isset($problems) && count($problems) > 0)
        <table>
            <thead>
                <tr>
                    <th>Event ID</th>
                    <th>Host Name</th>
                    <th>Name</th>
                    <th>Severity</th>
                    <th>Clock</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problems as $problem)
                    <tr>
                        <td>{{ $problem['eventid'] }}</td>
                        <td>{{ $problem['hostname'] }}</td>
                        <td>{{ $problem['name'] }}</td>
                        <td>{{ $problem['severity'] }}</td>
                        <td>{{ date('Y-m-d H:i:s', $problem['clock']) }}</td>
                        <td>
                            @if (isset($problem['tags']) && count($problem['tags']) > 0)
                                <ul>
                                    @foreach ($problem['tags'] as $tag)
                                        <li>{{ $tag['tag'] }}: {{ $tag['value'] }}</li>
                                    @endforeach
                                </ul>
                            @else
                                No Tags
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No problems found.</p>
    @endif
</body>
</html> -->



@extends('master')

@section('title')
Danh sách sự cố
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách sự cố</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('nhahangs.export') }}" class="badge badge-success mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <a href="{{ route('nhahangs.pdf') }}" class="badge badge-warning mb-3"><i class="fa icon-cloud-download"></i> Xuất PDF</a>
                <table id="multi-filter-select" class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Host Name</th>
                            <th>Name</th>
                            <th>Severity</th>
                            <th>Clock</th>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Event ID</th>
                            <th>Host Name</th>
                            <th>Name</th>
                            <th>Severity</th>
                            <th>Clock</th>
                            <th>Tags</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($problems as $problem)
                          <tr>
                              <td>{{ $problem['eventid'] }}</td>
                              <td>{{ $problem['hostname'] }}</td>
                              <td>{{ $problem['name'] }}</td>
                              <td>{{ $problem['severity'] }}</td>
                              <td>{{ date('Y-m-d H:i:s', $problem['clock']) }}</td>
                              <td>
                                  @if (isset($problem['tags']) && count($problem['tags']) > 0)
                                      <ul>
                                          @foreach ($problem['tags'] as $tag)
                                              <li>{{ $tag['tag'] }}: {{ $tag['value'] }}</li>
                                          @endforeach
                                      </ul>
                                  @else
                                      No Tags
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection