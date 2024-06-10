<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    </title>
    <!-- plugins:css -->
    @include('layout.style')
</head>

<body>
    <div class="container-scroller">
        <!-- navbar -->
        @include('components.navbar.master')

        <!-- page-body-wrapper start -->
        <div class="container-fluid page-body-wrapper">
            <!-- settings-panel & sidebar start-->
            @include('components.settingPanel.master')
            @include('components.sidebar.master')
            <!-- settings-panel & sidebar end-->

            <!-- main-panel start -->
            <div class="main-panel">
                <!-- content-wrapper start -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->

                <!-- footer start -->
                @include('components.footer.master')
                <!-- footer end -->
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
