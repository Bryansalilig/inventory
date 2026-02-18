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
    });
  </script>
@endpush
