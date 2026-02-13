@push('scripts')
  <script>
    $(document).ready(function () {
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
    });
  </script>
@endpush
