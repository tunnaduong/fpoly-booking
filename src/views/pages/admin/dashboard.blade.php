@extends('layout.main')
@section('content')
    {{-- Title start --}}
    <div class="row">
        @include('components.mainTitleContent.master');
    </div>
    {{-- Title end  --}}
    {{-- Hero start  --}}
    <div class="row">
        @include('components.hero.master');
        @include('components.dataCard.master');
    </div>
    {{-- Hero end ? --}}
    {{-- Overview start --}}
    <div class="row">
        @include('components.overviewChart.colChart');
        @include('components.overviewChart.lineChart');
    </div>
    {{-- Overview end --}}
@endsection
