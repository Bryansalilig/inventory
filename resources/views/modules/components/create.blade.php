@extends('layouts.main')

@section('title', 'Create Asset')

@section('content')
  <section class="p-2">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Component</h4>
        <a href="{{ route('components.index') }}" class="btn btn-light btn-sm">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          Back
        </a>
      </div>

      <div class="card">
        <div class="card-body p-3">
          <form method="POST" action="{{ route('components.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>
                  Name
                  <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required />

                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label>
                  Asset Tag
                  <span class="text-danger">*</span>
                </label>
                <select class="form-control form-control-sm @error('asset_tag') is-invalid @enderror" name="asset_tag" required>
                  <option value="" disabled {{ old('asset_tag') ? '' : 'selected' }}>Select</option>
                  <option value="ESCC-Keyboard">ESCC-Keyboard</option>
                  <option value="ESCC-Monitor">ESCC-Monitor</option>
                  <option value="ESCC-Mouse">ESCC-Mouse</option>
                  <option value="ESCC-Headset">ESCC-Headset</option>
                  <option value="ESCC-UPS">ESCC-UPS</option>
                  <option value="ESCC-CPU">ESCC-CPU</option>
                  <option value="ESCC-Camera">ESCC-Camera</option>
                </select>

                @error('asset_tag')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Picture</label>
                <input type="file" class="form-control form-control-sm @error('picture') is-invalid @enderror" name="picture" accept="image/png,image/jpeg,image/jpg" />

                @error('picture')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="text-right">
              <button class="btn btn-primary btn-sm">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
