@php
    /* 
    Các giá trị cần truyền vào:
        $card['table']['name']
        $card['table']['header']
        $card['table']['data']
    
    */

    $card = setVarAsDefault($card, [
        'title' => 'Main Title',
        'description' => 'detail',
        'table' => [
            // 'style' => 'hover',
            // 'name' => 'user',
            // 'header' => [
            //     'id' => '#',
            //     'first_name' => 'First name',
            //     'product' => 'Product',
            //     'amount' => 'Amount',
            //     'deadline' => 'Deadline',
            // ],
            // 'data' => [
            //     [
            //         'id' => 1,
            //         'first_name' => 'Herman Beck',
            //         'product' => 'Photoshop',
            //         'amount' => '$ 77.99',
            //         'deadline' => 'May 15, 2015',
            //         'class' => 'table-info',
            //     ],
            // ],
        ],
    ]);

    $tableName = $card['table']['name'] ?? 'defaut';

    $linkAction = setVarAsDefault($table, [
        'user' => '/user/',
        'defaut' => '/user/'
    ]);

    $action = setVarAsDefault($action, [
        'href' => [
            'edit' => $linkAction[$tableName] . 'edit/',
            'delete' => $linkAction[$tableName] . 'delete/',
        ],
    ]);
@endphp


<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{ $card['title'] }}</h4>
            <p class="card-description">{{ $card['description'] }}</p>
            <div class="table-responsive pt-3">
                <table class="table-hover">
                    {{-- No data table  --}}
                    @if ($card['table']['data'] == null)
                        <thead>
                            <tr>
                                <th>No data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No data</td>
                            </tr>
                        </tbody>
                    @else
                        {{-- Data table  --}}
                        <thead>
                            <tr>
                                @foreach ($card['table']['header'] as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($card['table']['data'] as $row)
                                <tr class="{{ $row['class'] }}">
                                    {{-- Data Colum  --}}
                                    @foreach ($row as $col => $data)
                                        <td>{{ $data }}</td>
                                    @endforeach
                                    {{-- Action Colum  --}}
                                    <td>
                                        <a href="{{ $action['href']['edit'] . $row['id'] }}" class="btn btn-success"
                                            onclick="return confirm('Are you sure you want to edit?')">Edit</a>
                                        <a href="{{ $action['href']['delete'] . $row['id'] }}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
