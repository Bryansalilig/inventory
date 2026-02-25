@push('scripts')
  <script>
    $(document).ready(function () {
      const dashIfEmpty = (data) => data ?? '-';

      const arrayOrDash = (data) => {
        if (!Array.isArray(data) || data.length === 0) {
          return '-';
        }
        return data.join(', ');
      };

      $('#employeeTable').DataTable({
        ajax: '{{ route('employees.getData') }}',
        columns: [
          { data: 'employee_name', render: dashIfEmpty },
          { data: 'cubicle_name', render: dashIfEmpty },
          { data: 'cpu_tag', render: dashIfEmpty },
          { data: 'keyboard_tag', render: dashIfEmpty },
          { data: 'mouse_tag', render: dashIfEmpty },
          { data: 'headset_tag', render: dashIfEmpty },
          { data: 'monitor_tags', render: arrayOrDash },
          { data: 'camera_tag', render: dashIfEmpty },
          { data: 'ups_tag', render: dashIfEmpty },
          {
            data: 'action',
            orderable: false,
            searchable: false,
            render: (data) => data,
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

      $(document).on('click', '.btn-employee', function () {
        const id = $(this).data('id');
        const employee_id = $(this).data('employee-id');

        $('#id').val(id);
        $('#employee_id').val(employee_id);

        // clear previous options except the placeholder
        $('#employee').html('<option value="" selected disabled>Select Employee</option>');

        const url = '{{ route('employees-api.employeeDropdown') }}';
        // fetch employees from API
        $.ajax({
          url: url,
          method: 'GET',
          dataType: 'json',
          success: function (res) {
            if (res.status === 'success' && res.data.length) {
              console.log(res.data);
              res.data.forEach((emp) => {
                let pos = emp.position ?? 'N/A';
                if (pos.length > 20) {
                  pos = pos.substring(0, 20) + '...';
                }

                $('#employee').append(`
                  <option value="${emp.id}" data-fullname="${emp.fullname}" data-position="${emp.position}">
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

      $(document).on('click', '.btn-cubicle', function () {
        const id = $(this).data('id');
        const employee_name = $(this).data('employee-name');

        $('#cubicleModal #id').val(id);
        $('#cubicleModal #employee_name').text(employee_name);

        // clear previous options except the placeholder
        $('#cubicle').html('<option value="" selected disabled>Select Cubicle</option>');

        const url = '{{ route('cubicles.dropDown') }}';
        // fetch cubicles
        $.ajax({
          url: url,
          method: 'GET',
          dataType: 'json',
          success: function (res) {
            if (res.status === 'success' && res.data.length) {
              console.log(res.data);
              res.data.forEach((c) => {
                $('#cubicle').append(`
                  <option value="${c.id}" data-cubicle-name="${c.name}" data-location="${c.location}">
                      ${c.name} (${c.location})
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

      $('#cubicleForm').on('submit', function (e) {
        e.preventDefault();

        const id = $('#cubicleModal #id').val();

        const url = '{{ route('employees.update', ':id') }}'.replace(':id', id);

        $.ajax({
          url: url,
          type: 'POST',
          data: $(this).serialize(),
          success: function (response) {
            $('#cubicleModal').modal('hide');

            // Optional toast (make sure toastr is included)
            toastr.success(response.message);

            // ✅ Refresh DataTable only (smooth, no full page reload)
            $('#employeeTable').DataTable().ajax.reload(null, false);
          },
          error: function (xhr) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              $('#stock-message').text(errors.quantity?.[0] ?? '');
            }
          },
        });
      });

      // Submit form via AJAX
      $('#employeeForm').on('submit', function (e) {
        e.preventDefault();

        const fullname = $('#employee option:selected').data('fullname');
        const position = $('#employee option:selected').data('position');

        let formData = $(this).serializeArray();

        formData.push({ name: 'new_employee_name', value: fullname });
        formData.push({ name: 'new_employee_position', value: position });

        $.ajax({
          url: '{{ route('employees.updateEmployee') }}',
          type: 'PUT',
          data: $.param(formData),
          success: function (response) {
            $('#employeeModal').modal('hide');
            // Show toast / alert

            toastr.success(response.message, null, {
              timeOut: 1000,
            });

            // ✅ Refresh DataTable only (smooth, no full page reload)
            $('#employeeTable').DataTable().ajax.reload(null, false);
          },
          error: function () {
            alert('Something went wrong. Try again.');
          },
        });
      });
    });
  </script>
@endpush
