@push('scripts')
  <script>
    $(document).ready(function () {
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
          data: {
            location: location,
            type: type,
          },
          success: function (res) {
            $('#last_cubicle').val(res.last_cubicle ?? 'None');
          },
          error: function () {
            $('#last_cubicle').val('Error');
          },
        });
      }

      $('#location, #name').on('change', fetchLastCubicle);
    });
  </script>
@endpush
