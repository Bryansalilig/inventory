@push('scripts')
  <script>
    $(document).ready(function () {
      $(document).on('click', '.btn-maintenance', function () {
        var id = $(this).data('id');
        var component_id = $(this).data('component-id');
        var component_stock_id = $(this).data('component-stock-id');
        var employee_id = $(this).data('employee-id');
        var name = $(this).data('name');
        var asset_tag = $(this).data('asset-tag');
        var model_type = $(this).data('model-type');
        $('#maintenanceModal #display_name').text(name);
        $('#maintenanceModal #display_asset_tag').text(asset_tag);
        $('#maintenanceModal #display_model_type').text(model_type);
        $('#maintenanceModal #component_id').val(component_id);
        $('#maintenanceModal #component_stock_id').val(component_stock_id);
        $('#maintenanceModal #employee_id').val(employee_id);
        $('#maintenanceModal #asset_tag').val(asset_tag);
        $('#maintenanceModal #id').val(id);
      });

      $(document).on('click', '.btn-assign', function () {
        var id = $(this).data('id');
        var component_id = $(this).data('component-id');
        var name = $(this).data('name');
        var asset_tag = $(this).data('asset-tag');
        var model_type = $(this).data('model-type');
        $('#assignModal #d_name').text(name);
        $('#assignModal #d_asset_tag').text(asset_tag);
        $('#assignModal #d_model_type').text(model_type);
        $('#assignModal #assign_asset_tag').val(asset_tag);
        $('#assignModal #id').val(id);
        $('#assignModal #component_id').val(component_id);

        // clear previous options except the placeholder
        $('#employee').html('<option value="" selected disabled>Select Employee</option>');

        const url = '{{ route('employees-api.employeeAssetDropdown', ':id') }}'.replace(':id', component_id);
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

      $('#assetTable').DataTable({
        ajax: '{{ route('assets.getData') }}',
        columns: [
          {
            data: 'picture',
            orderable: false,
            searchable: false,
            render: function (data, type, row) {
              if (!data) {
                return `<span class="text-muted">No Image</span>`;
              }

              return `
                <div class="img-hover-wrapper">
                  <img src="${data}" class="dt-thumb" />
                  <div class="img-hover-preview">
                    <img src="${data}" />
                  </div>
                </div>
              `;
            },
          },
          { data: 'name' },
          { data: 'model_type' },
          { data: 'asset_tag' },
          { data: 'employee_name' },
          { data: 'employee_position' },
          { data: 'checkout_date' },
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

      $('#maintenanceForm').submit(function (e) {
        e.preventDefault(); // prevent normal submit

        let $form = $(this);
        let $submitButton = $form.find('button[type="submit"]');
        $submitButton.prop('disabled', true).text('Moving...').css('color', 'black'); // set text color to black

        $.ajax({
          url: '{{ route('maintenance.store') }}',
          method: 'POST',
          data: $form.serialize(),
          dataType: 'json',
          success: function (response) {
            // Close modal
            $('#maintenanceModal').modal('hide');

            // Reset form
            $form[0].reset();
            $submitButton.prop('disabled', false).text('Move');

            // Show toast / alert
            toastr.success(response.message);

            $('#assetTable').DataTable().ajax.reload(null, false);
          },
          error: function (xhr) {
            handleAjaxError(xhr, $submitButton, 'Move');
          },
        });
      });

      $('#assignForm').submit(function (e) {
        e.preventDefault();

        const fullname = $('#employee option:selected').data('fullname');
        const position = $('#employee option:selected').data('position');

        let formData = $(this).serializeArray();

        formData.push({ name: 'employee_name', value: fullname });
        formData.push({ name: 'employee_position', value: position });

        let $form = $(this);
        let $submitButton = $form.find('button[type="submit"]');

        $submitButton.prop('disabled', true).text('Assigning...').css('color', 'black');

        $.ajax({
          url: '{{ route('assets.store') }}',
          method: 'POST',
          data: $.param(formData), // ✅ FIXED
          dataType: 'json',
          success: function (response) {
            $('#assignModal').modal('hide');
            $form[0].reset();

            $submitButton.prop('disabled', false).text('Assign').css('color', '');

            toastr.success(response.message);

            $('#assetTable').DataTable().ajax.reload(null, false);
          },
          error: function (xhr) {
            handleAjaxError(xhr, $submitButton, 'Assign');
          },
        });
      });

      function handleAjaxError(xhr, $button = null, defaultText = 'Submit') {
        if ($button) $button.prop('disabled', false).text(defaultText);
        let response = xhr.responseJSON || {};

        if (xhr.status === 422 && response.errors) {
          let errorMessages = Object.values(response.errors).flat().join('<br>');
          toastr.error(errorMessages);
        } else if (xhr.status === 419) {
          toastr.error('Session expired. Please refresh the page.');
        } else if (response.message) {
          toastr.error(response.message);
        } else {
          toastr.error('Something went wrong. Please try again.');
        }
      }
    });
  </script>
@endpush
