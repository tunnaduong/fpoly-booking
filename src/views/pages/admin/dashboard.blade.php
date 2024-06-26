@extends('layout.main')
@section('content')
    <div class="row">
        @include('components.mainTitleContent.master');
    </div>
    <div class="row">
        @include('components.hero.master');
        @include('components.dataCard.master');
    </div>
    <div class="row">
        @include('components.overviewChart.colChart');
        @include('components.overviewChart.lineChart');
    </div>

@endsection
