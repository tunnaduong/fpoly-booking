@extends('layout.main')
@section('content')
    <div class="row">
        @include('components.mainTitleContent.master');
    </div>
    <div class="row">
        <button type="submit" name="add">Add</button>
        <form action="" method="POST">
            <input type="search" name="txtsearch">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="row">
        @include('components.tables.master');
    </div>
@endsection
