@push('scripts')
  <script>
    $(document).ready(function () {
      const maintenanceURL = $('#maintenanceTable').data('url');

      $('#maintenanceTable').DataTable({
        ajax: maintenanceURL,
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
          { data: 'model_type' },
          { data: 'status' },
          { data: 'description' },
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
        dom: 'Bfrtip',
        buttons: [],
        pageLength: 10, // match $perPage
      });
    });
  </script>
@endpush
