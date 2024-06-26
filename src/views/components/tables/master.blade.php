@php
    $tableStyle = [
        'hover' => 'table-hover',
        'striped' => 'table-striped',
        'bordered' => 'table-bordered',
    ];

    $card = $card ?? [
        'title' => 'Main Title',
        'description' => 'detail',
        'table' => [
            'style' => 'hover',
            'header' => [
                'id' => '#',
                'first_name' => 'First name',
                'product' => 'Product',
                'amount' => 'Amount',
                'deadline' => 'Deadline',
            ],
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'Herman Beck',
                    'product' => 'Photoshop',
                    'amount' => '$ 77.99',
                    'deadline' => 'May 15, 2015',
                    'class' => 'table-info',
                ],
            ],
        ],
    ];
@endphp


<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $card['title'] }}</h4>
            <p class="card-description">{{ $card['description'] }}</p>
            <div class="table-responsive pt-3">
                <table class="table {{ $tableStyle[$card['table']['style']] }}">
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
                                    <a href="" class="btn btn-success"
                                        onclick="return confirm('Are you sure you want to edit?')">Edit</a>
                                    <a href="" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
