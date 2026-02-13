@push('scripts')
  <script>
    $(document).ready(function () {
      const url = $('#assetTable').data('url');

      $('#assetTable').DataTable({
        ajax: url,
        columns: [
          { data: 'model_type' },
          { data: 'cost' },
          { data: 'qty_display' },
          { data: 'specification' },
          { data: 'supplier' },
          { data: 'purchase_date' },
          {
            data: 'action',
            orderable: false,
            searchable: false,
            render: function (data) {
              return data;
            },
          },
        ],
        order: [[0, 'desc']],
        dom: "<'row mb-3'<'col-sm-6'B><'col-sm-6'f>>" + "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
          { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i> Copy', className: 'btn btn-info btn-sm' },
          {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success btn-sm',
          },
          { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i> CSV', className: 'btn btn-warning btn-sm' },
          {
            extend: 'pdfHtml5',
            text: '<i class="fa fa-file-pdf-o"></i> PDF',
            className: 'btn btn-danger btn-sm',
            orientation: 'landscape',
            pageSize: 'A4',
          },
          { extend: 'print', text: '<i class="fa fa-print"></i> Print', className: 'btn btn-primary btn-sm' },
        ],
        pageLength: 10, // match $perPage
      });
    });

    $(document).on('click', '.btn-checkout', function () {
      const id = $(this).data('id');
      const name = $(this).data('name');

      // set component_id hidden input
      $('#checkout_id').val(id);
      $('#component_name').val(name);

      // clear previous options except the placeholder
      $('#employee').html('<option value="" selected disabled>Select Employee</option>');

      // fetch employees from API
      $.ajax({
        url: '/employees', // employees.index route
        method: 'GET',
        dataType: 'json',
        success: function (res) {
          if (res.status === 'success' && res.data.length) {
            res.data.forEach((emp) => {
              let pos = emp.position ?? 'N/A';
              if (pos.length > 20) {
                pos = pos.substring(0, 20) + '...';
              }

              $('#employee').append(`
        <option value="${emp.id}" data-fullname="${emp.fullname}" data-position="${pos}">
            ${emp.fullname} (${pos})
        </option>
    `);
            });
          }
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to fetch employees. Please try again.',
          });
        },
      });
    });

    $('#checkoutForm').on('submit', function (e) {
      e.preventDefault();

      const component_id = $('#checkout_id').val();
      const checkout_qty = $('#checkout_qty').val();
      const selectedOption = $('#employee option:selected');
      const employee_id = selectedOption.val();
      const fullname = selectedOption.data('fullname');
      const position = selectedOption.data('position');
      const checkout_date = $(this).find('input[name="checkout_date"]').val();

      const payload = {
        component_id,
        checkout_qty,
        employee_id,
        fullname,
        position,
        checkout_date,
      };

      // send via AJAX or normal form submit
      $.ajax({
        url: '{{ route('components.component-checkout') }}', // your backend route
        method: 'POST',
        data: payload,
        success: function (res) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Component checked out successfully!',
            timer: 2000,
            showConfirmButton: false,
          });
          $('#checkoutModal').modal('hide');
          // optional: refresh table
        },
        error: function (err) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to checkout component.',
          });
        },
      });
    });
  </script>
@endpush
