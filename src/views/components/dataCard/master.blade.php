@php
    $data = [
        'bookings' => [
            'title' => 'Today’s Bookings',
            'value' => 4006,
            'percentage' => 10.0,
        ],
        'total' => [
            'title' => 'Total Bookings',
            'value' => 61344,
            'percentage' => 22.0,
        ],
        'meetings' => [
            'title' => 'Number of Meetings',
            'value' => 34040,
            'percentage' => 2.0,
        ],
        'clients' => [
            'title' => 'Number of Clients',
            'value' => 47033,
            'percentage' => 0.22,
        ],
    ];
@endphp

<div class="col-md-6 grid-margin transparent">
    <div class="row">
        @foreach($data as $key => $value)
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4">{{ $value['title'] }}</p>
                    <p class="fs-30 mb-2">{{ $value['value'] }}</p>
                    <p>{{ $value['percentage'] }}% (30 days)</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
