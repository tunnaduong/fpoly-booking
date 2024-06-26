@extends('layout.main')
@section('content')
    @php
        $mainTitleContent = 'User';
    @endphp

    @include('pages.admin.manage.tableAction');
@endsection
