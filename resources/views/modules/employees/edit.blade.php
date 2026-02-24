@extends('layouts.main')

@section('title', 'Edit Employee Asset')

@include('modules.employees.styles')

@section('content')
  <section class="p-2">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Component</h4>
        <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          Back
        </a>
      </div>

      <div class="card">
        <div class="card-body p-3">
          <div class="asset-container">
            <h5>{{ $employee->employee_name }}</h5>
            @php
              // Map all single-value assets
              $singleAssets = [
                'System Unit' => [
                  'tag' => $employee->cpu_tag ?? '-',
                  'component_id' => $employee->cpu_component_id,
                ],
                'Keyboard' => [
                  'tag' => $employee->keyboard_tag ?? '-',
                  'component_id' => $employee->keyboard_component_id,
                ],
                'Mouse' => [
                  'tag' => $employee->mouse_tag ?? '-',
                  'component_id' => $employee->mouse_component_id,
                ],
                'Headset' => [
                  'tag' => $employee->headset_tag ?? '-',
                  'component_id' => $employee->headset_component_id,
                ],
                'Camera' => [
                  'tag' => $employee->camera_tag ?? '-',
                  'component_id' => $employee->camera_component_id,
                ],
                'UPS' => [
                  'tag' => $employee->ups_tag ?? '-',
                  'component_id' => $employee->ups_component_id,
                ],
              ];
            @endphp

            <div class="row">
              {{-- Single-value assets --}}
              @foreach ($singleAssets as $label => $data)
                @php
                  $isEmpty = $data['tag'] === '-';
                @endphp

                <div class="col-md-3 mb-3">
                  <div class="asset-card text-center p-3 border rounded {{ $isEmpty ? 'asset-card--empty' : '' }}" data-id="{{ $employee->id }}" data-component-id="{{ $data['component_id'] }}" data-tag="{{ $data['tag'] }}" {{ $isEmpty ? 'data-disabled="true"' : '' }}>
                    <h6>{{ $data['tag'] }}</h6>
                    <span>{{ $label }}</span>
                  </div>
                </div>
              @endforeach

              {{-- Monitor tags (array) --}}
              @forelse ($employee->monitor_tags ?? [] as $key => $tag)
                @php
                  $isEmpty = $tag === '-';
                @endphp

                <div class="col-md-3 mb-3">
                  <div class="asset-card text-center p-3 border rounded {{ $isEmpty ? 'asset-card--empty' : '' }}" data-id="{{ $employee->id }}" data-component-id="{{ $employee->monitor_component_id }}" data-tag="{{ $tag }}" {{ $isEmpty ? 'data-disabled="true"' : '' }}>
                    <h6>{{ $tag }}</h6>
                    <span>Monitor {{ $key + 1 }}</span>
                  </div>
                </div>
              @empty
                <div class="col-md-3 mb-3">
                  <div class="asset-card text-center p-3 border rounded asset-card--empty" data-disabled="true">
                    <h6>-</h6>
                    <span>Monitor</span>
                  </div>
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="assetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="assetForm">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="assetModalLabel">Update System Unit</h5>
            <button type="button" class="btn-close" data-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="component_id" id="component_id" />
            <input type="hidden" name="asset_tag" id="asset_tag" />
            <h6 id="asset_tag_display"></h6>
            <div class="mb-3">
              <label for="selected_asset_tag" class="form-label">Select Tag</label>
              <select class="select2" name="selected_asset_tag" id="selected_asset_tag">
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      const CacheService = {
        ttl: 5 * 60 * 1000, // 5 minutes

        get(key) {
          const item = sessionStorage.getItem(key);
          if (!item) return null;

          const parsed = JSON.parse(item);

          const isExpired = Date.now() - parsed.timestamp > this.ttl;

          if (isExpired) {
            sessionStorage.removeItem(key);
            return null;
          }

          return parsed.data;
        },

        set(key, data) {
          sessionStorage.setItem(
            key,
            JSON.stringify({
              data: data,
              timestamp: Date.now(),
            })
          );
        },
      };

      // Click asset card
      $('.asset-card').on('click', function () {
        if ($(this).data('disabled')) return; // ignore empty cards

        let employeeId = $(this).data('id');
        let component_id = $(this).data('component-id');
        let tag = $(this).data('tag');

        $('#component_id').val(component_id);
        $('#asset_tag').val(tag);
        $('#asset_tag_display').text(tag);

        $('#assetModal').modal('show');

        const cacheKey = `asset_${employeeId}_${component_id}`;

        const cachedData = CacheService.get(cacheKey);

        if (cachedData) {
          console.log('Loaded from session cache');
          populateSelect(cachedData, tag);
          return;
        }

        console.log('Fetching from backend...');

        $.ajax({
          url: '{{ route('employees.data') }}',
          method: 'GET',
          dataType: 'json',
          data: {
            id: employeeId,
            component_id: component_id,
          },
          success: function (res) {
            if (res.status === 'success') {
              CacheService.set(cacheKey, res.data);

              populateSelect(res.data, tag);
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

      function populateSelect(data, currentTag) {
        const select = $('#selected_asset_tag');
        select.empty();

        const options = data.map((item) => ({
          id: item.id,
          text: `${item.asset_tag ?? 'NO TAG'}${item.employee_name ? ' - ' + item.employee_name : ''}`,
        }));

        select.select2({
          data: options,
          width: '100%',
          dropdownParent: $('#assetModal'),
        });

        const matched = data.find((item) => item.asset_tag === currentTag);

        if (matched) {
          select.val(matched.id).trigger('change');
        }
      }

      // Submit form via AJAX
      $('#assetForm').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
          url: '{{ route('assets.update') }}', // Laravel route
          type: 'PUT',
          data: formData,
          success: function (response) {
            alert('Asset updated successfully!');
            $('#assetModal').modal('hide');
            // Optionally, update the card value without refresh
          },
          error: function (xhr) {
            alert('Something went wrong. Try again.');
          },
        });
      });
    });
  </script>
@endpush
