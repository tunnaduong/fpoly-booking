<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    @include('layout.style')
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
</body>

</html>
