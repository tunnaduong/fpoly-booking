@extends('layout.main')
@section('title', 'Quản lý người dùng')
@section('content')
    @php
        $mainTitleContent = 'User';
    @endphp
    @include('pages.admin.manage.tableAction')
@endsection
