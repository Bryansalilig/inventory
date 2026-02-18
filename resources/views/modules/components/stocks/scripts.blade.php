@push('scripts')
  <script>
    $(document).ready(function () {
      const detailUrl = $('#stockDetailTable').data('url');

      $.ajax({
        url: detailUrl,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          // Populate table cells
          $('#model_type').text(data.model_type ?? '-');
          $('#cost').text(data.cost ? '₱' + parseFloat(data.cost).toLocaleString() : '-');
          $('#quantity').text(data.quantity ?? '-');
          $('#available_component').text(data.available_component ?? '-');
          $('#specification').text(data.specification ?? '-');
          $('#supplier').text(data.supplier ?? '-');
          $('#purchase_date').text(data.purchase_date ?? '-');
          $('#created_at').text(data.created_at ?? '-');
        },
      });

      const assetUrl = $('#assetTable').data('url');

      $('#assetTable').DataTable({
        ajax: assetUrl,
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

      const historyUrl = $('#historyTable').data('url');

      $('#historyTable').DataTable({
        ajax: historyUrl,
        columns: [{ data: 'asset_tag' }, { data: 'employee_name' }, { data: 'quantity' }, { data: 'user_name' }, { data: 'created_at' }],
        order: [[0, 'desc']],
        pageLength: 10, // match $perPage
        dom: 'Bfrtip',
        buttons: [],
      });
    });

    $(document).on('click', '.btn-checkout', function () {
      const id = $(this).data('id');
      const model_type = $(this).data('model-type');
      const available_component = $(this).data('available-component');
      const component_id = $('#component_id').val();

      // set component_stock_id hidden input
      $('#component_stock_id').val(id);
      $('#model_type').val(model_type);
      setCheckoutQtyInput($('#component_name').val());

      // clear previous options except the placeholder
      $('#employee').html('<option value="" selected disabled>Select Employee</option>');

      const url = '{{ route('employees-api.employeeFiltered', ':id') }}'.replace(':id', component_id);
      // fetch employees from API
      $.ajax({
        url: url,
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

      const component_stock_id = $('#component_stock_id').val();
      const component_id = $('#component_id').val();
      const asset_tag = $('#asset_tag').val();
      const checkout_qty = $('#checkout_qty').val();
      const selectedOption = $('#employee option:selected');
      const employee_id = selectedOption.val();
      const fullname = selectedOption.data('fullname');
      const position = selectedOption.data('position');
      const checkout_date = $(this).find('input[name="checkout_date"]').val();

      const payload = {
        component_stock_id,
        component_id,
        asset_tag,
        checkout_qty,
        employee_id,
        fullname,
        position,
        checkout_date,
      };

      // ✅ dynamic route
      const url = '{{ route('components.stocks.checkout', ':id') }}'.replace(':id', component_stock_id);

      $.ajax({
        url: url,
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
          // ✅ Refresh DataTable only (smooth, no full page reload)
          $('#assetTable').DataTable().ajax.reload(null, false);
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

    function setCheckoutQtyInput(componentName) {
      const $input = $('#checkout_qty');
      const $message = $('#stock-message');

      let maxQty = componentName === 'Monitor' ? 2 : 1;

      $input.val(1).attr('min', 1).attr('max', maxQty).prop('disabled', false);
      $message.text('');

      // Enforce boundaries while typing
      $input.off('input').on('input', function () {
        let val = parseInt($(this).val(), 10) || 0;
        const max = parseInt($(this).attr('max'), 10);
        const min = parseInt($(this).attr('min'), 10);

        if (val > max) $(this).val(max);
        if (val < min) $(this).val(min);
      });
    }
  </script>
@endpush
