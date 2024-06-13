@php
    $card = [
        'title' => 'Table with contextual classes',
        'description' => 'Add class <code>.table-{color}</code>',
        'table' => [
            'class' => [],
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'Herman Beck',
                    'product' => 'Photoshop',
                    'amount' => '$ 77.99',
                    'deadline' => 'May 15, 2015',
                    'class' => 'table-info',
                ],
                [
                    'id' => 2,
                    'first_name' => 'Messsy Adam',
                    'product' => 'Flash',
                    'amount' => '$245.30',
                    'deadline' => 'July 1, 2015',
                    'class' => 'table-warning',
                ],
                [
                    'id' => 3,
                    'first_name' => 'John Richards',
                    'product' => 'Premeire',
                    'amount' => '$138.00',
                    'deadline' => 'Apr 12, 2015',
                    'class' => 'table-danger',
                ],
                [
                    'id' => 4,
                    'first_name' => 'Peter Meggik',
                    'product' => 'After effects',
                    'amount' => '$ 77.99',
                    'deadline' => 'May 15, 2015',
                    'class' => 'table-success',
                ],
                [
                    'id' => 5,
                    'first_name' => 'Edward',
                    'product' => 'Illustrator',
                    'amount' => '$ 160.25',
                    'deadline' => 'May 03, 2015',
                    'class' => 'table-primary',
                ],
            ],
        ],
    ];
@endphp


<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Table with contextual classes</h4>
            <p class="card-description">Add class <code>.table-{color}</code></p>
            <div class="table-responsive pt-3"> 9
                <table class="table table- " >     .
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First name</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-info">
                            <td>1</td>
                            <td>Herman Beck</td>
                            <td>Photoshop</td>
                            <td>$ 77.99</td>
                            <td>May 15, 2015</td>
                        </tr>
                        <tr class="table-warning">
                            <td>2</td>
                            <td>Messsy Adam</td>
                            <td>Flash</td>
                            <td>$245.30</td>
                            <td>July 1, 2015</td>
                        </tr>
                        <tr class="table-danger">
                            <td>3</td>
                    9        <td>John Richards</td>
                            <td>Premeire</td>
                            <td>$138.00</td>
                            <td>Apr 12, 2015</td>
                        </tr>
                        <tr class="table-success">
                            <td>4</td>
                            <td>Peter Meggik</td>
                            <td>After effects</td>
                            <td>$ 77.99</td>
                            <td>May 15, 2015</td>
                        </tr>
                        <tr class="table-primary">
                            <td>5</td>
                            <td>Edward</td>
                            <td>Illustrator</td>
                            <td>$ 160.25</td>
                            <td>May 03, 2015</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
