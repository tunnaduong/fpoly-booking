<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('title')
    <!-- plugins:css -->
    @include('layout.style')
    @yield('styles')
</head>

<body>
    <div class="container-scroller">
        <!-- navbar -->
        @include('components.navbar.master')

        <!-- page-body-wrapper start -->
        <div class="container-fluid page-body-wrapper">
            <!-- settings-panel -->
            @include('components.settingPanel.master')

            <!-- sidebar -->
            @include('components.sidebar.master')
            
            <!-- main-panel start -->
            <div class="main-panel">
                @yield('content')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('layout.script')
    @yield('scripts')
</body>

</html>
