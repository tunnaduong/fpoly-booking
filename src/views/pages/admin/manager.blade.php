@extends('layout.main')
@section('content')
    {{-- Title start --}}
    <div class="row">
        @include('components.mainTitleContent.master')
    </div>
    {{-- Title end  --}}
    <div class="row">
        <button type="submit"><a href="">Add</a></button>
        <input type="search" placeholder="Search" name="txtsearch" id="">
        <button type="submit"><a href="">Search</a></button>
    </div>
    <div class="row">
        @include('components.tables.master')
    </div>
@endsection
