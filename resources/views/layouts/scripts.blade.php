<!-- Core / Vendor Scripts (GLOBAL) -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Plugins -->
<script src="{{ asset('plugin/chart/moment.min.js') }}"></script>
<script src="{{ asset('plugin/chart/Chart.min.js') }}"></script>
<script src="{{ asset('plugin/chart/utils.js') }}"></script>

<script src="{{ asset('plugin/jqueryvalidation/jquery.validate.js') }}"></script>
<script src="{{ asset('plugin/jqueryvalidation/additional-methods.js') }}"></script>

<script src="{{ asset('plugin/datatables2/datatables.min.js') }}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- App-wide JS -->
<script src="{{ asset('js/general.js') }}"></script>

@if (session('flash'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: '{{ session('flash.type') }}', // success, error, info
        title: '{{ ucfirst(session('flash.type')) }}',
        text: '{{ session('flash.message') }}',
        timer: 2000,
        showConfirmButton: false,
      });
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    });
  </script>
@endif
