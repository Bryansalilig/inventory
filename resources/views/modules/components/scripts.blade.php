@push('scripts')
  <script>
    $(document).ready(function () {
      $('#assetTable').DataTable({
        ajax: '{{ route('components.getData') }}',
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
          { data: 'asset_tag' },
          {
            data: 'available_component',
            width: '200px',
            className: 'text-center',
          },
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
  </script>
@endpush
