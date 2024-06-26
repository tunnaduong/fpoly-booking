@extends('layout.main')
@section('title', 'Dashboard Admin')
@section('content')
    {{-- start mainTittleContent  --}}
    <div class="row">
        @include('components.mainTitleContent.master')
    </div>
    {{-- end mainTittleContent --}}
    {{-- start dataCard  --}}
    <div class="row">
        @include('components.hero.master')
        @include('components.dataCard.master')
    </div>
    {{-- end dataCard --}}
    {{-- start overviewChart  --}}
    <div class="row">
        @include('components.overviewChart.colChart')
        @include('components.overviewChart.lineChart')
    </div>
    {{-- end overviewChart --}}
@endsection
