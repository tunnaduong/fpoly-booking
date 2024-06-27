  <!-- plugins:js -->
  <script src="{{ BASE_URL . 'vendors/js/vendor.bundle.base.js' }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ BASE_URL . 'vendors/chart.js/Chart.min.js' }}"></script>
  <script src="{{ BASE_URL . 'vendors/datatables.net/jquery.dataTables.js' }}"></script>
  <script src="{{ BASE_URL . 'vendors/datatables.net-bs4/dataTables.bootstrap4.js' }}"></script>
  <script src="{{ BASE_URL . 'js/dataTables.select.min.js' }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ BASE_URL . 'js/off-canvas.js' }}"></script>
  <script src="{{ BASE_URL . 'js/hoverable-collapse.js' }}"></script>
  <script src="{{ BASE_URL . 'js/template.js' }}"></script>
  <script src="{{ BASE_URL . 'js/settings.js' }}"></script>
  <script src="{{ BASE_URL . 'js/todolist.js' }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ BASE_URL . 'js/dashboard.js' }}"></script>
  <script src="{{ BASE_URL . 'js/Chart.roundedBarCharts.js' }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- End custom js for this page-->

  <script type="text/javascript">
      toastr.options = {
          "closeButton": false, // Hiển thị nút đóng
          "debug": false, // Hiển thị debug messages
          "newestOnTop": true, // Thông báo mới nhất hiển thị trên cùng
          "progressBar": true, // Hiển thị thanh tiến trình
          "positionClass": "toast-top-right", // Vị trí của thông báo
          "preventDuplicates": false, // Ngăn chặn thông báo trùng lặp
          "onclick": null, // Hàm gọi khi nhấp vào thông báo
          "showDuration": "300", // Thời gian hiển thị thông báo
          "hideDuration": "1000", // Thời gian ẩn thông báo
          "timeOut": "5000", // Thời gian tự động đóng thông báo
          "extendedTimeOut": "1000", // Thời gian tự động đóng thông báo khi di chuột qua
          "showEasing": "swing", // Hiệu ứng hiển thị
          "hideEasing": "linear", // Hiệu ứng ẩn
          "showMethod": "slideDown", // Phương pháp hiển thị
          "hideMethod": "slideUp", // Phương pháp ẩn
      }
  </script>


  @php
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
  @endphp
  @if (isset($_SESSION['flash']))

      @foreach ($_SESSION['flash'] as $key => $message)
          @if ($key == 'success')
              <script>
                  toastr.success('{{ $message }}');
              </script>
          @elseif ($key == 'error')
              <script>
                  toastr.error('{{ $message }}');
              </script>
          @elseif ($key == 'info')
              <script>
                  toastr.infor('{{ $message }}');
              </script>
          @elseif ($key == 'warning')
              <script>
                  toastr.warning('{{ $message }}');
              </script>
          @endif
      @endforeach




      @php unset($_SESSION['flash']); @endphp
  @endif
