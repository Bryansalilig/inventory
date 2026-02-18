@push('scripts')
  <script>
    $(document).ready(function () {
      // --- Fetch last cubicle ---
      function fetchLastCubicle() {
        let location = $('#location').val();
        let type = $('#name').val();

        if (!location || !type) {
          $('#last_cubicle').val('');
          return;
        }

        $.ajax({
          url: '/cubicles/last',
          type: 'GET',
          data: { location: location, type: type },
          success: function (res) {
            $('#last_cubicle').val(res.last_cubicle ?? 'None');
          },
          error: function () {
            $('#last_cubicle').val('Error');
          },
        });
      }

      $('#location, #name').on('change', fetchLastCubicle);

      // --- DataTables management ---
      const cubicleTables = {}; // store table instances
      const tableSelectors = ['#HRFloorTable', '#firstFloorTable', '#secondFloorTable', '#thirdFloorTable', '#fourthFloorTable'];

      function initCubicleTable(selector, options = {}) {
        const url = $(selector).data('url');

        const table = $(selector).DataTable({
          ajax: url,
          columns: options.columns ?? [
            { data: 'name' },
            { data: 'location' },
            { data: 'location' },
            {
              data: 'action',
              orderable: false,
              searchable: false,
            },
          ],
          order: options.order ?? [[0, 'desc']],
          pageLength: options.pageLength ?? 10,
          dom: options.dom ?? 'Bfrtip',
          buttons: options.buttons ?? [],
        });

        cubicleTables[selector] = table; // save reference
        return table;
      }

      // Initialize all tables
      tableSelectors.forEach((selector) => initCubicleTable(selector));

      // --- Reload all tables function ---
      function reloadAllCubicleTables() {
        for (let selector in cubicleTables) {
          cubicleTables[selector].ajax.reload(null, false);
        }
      }

      // --- Quantity limits ---
      const MIN_QTY = 1;
      const MAX_QTY = 100;

      $('#quantity').on('input', function () {
        let value = Number(this.value);
        if (value < MIN_QTY) this.value = MIN_QTY;
        if (value > MAX_QTY) this.value = MAX_QTY;
      });

      // --- AJAX form submission ---
      $('#cubicleForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: $(this).serialize(),
          success: function (response) {
            $('#cubicleModal').modal('hide');
            $('#cubicleForm')[0].reset();

            // Reload ALL cubicle tables
            reloadAllCubicleTables();

            // Optional toast (make sure toastr is included)
            toastr.success(response.message);
          },
          error: function (xhr) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              $('#stock-message').text(errors.quantity?.[0] ?? '');
            }
          },
        });
      });
    });
  </script>
@endpush
