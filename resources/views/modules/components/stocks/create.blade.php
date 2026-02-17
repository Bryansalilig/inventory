@extends('layouts.main')

@section('title', 'Create Asset')

@section('content')
  <section class="p-2">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Stock</h4>
        <a href="{{ route('components.stocks.index', $component) }}" class="btn btn-light btn-sm">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          Back
        </a>
      </div>

      <div class="card">
        <div class="card-body p-3">
          <form method="POST" action="{{ route('components.stocks.store', $component) }}" autocomplete="off">
            @csrf

            <input type="hidden" name="component_id" value="{{ $component->id }}" />
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>
                  Model Type
                  <span class="text-danger">*</span>
                </label>
                <input
                  type="text"
                  class="form-control form-control-sm @error('model_type') is-invalid @enderror"
                  name="model_type"
                  value="{{ old('model_type') }}"
                  required
                />

                @error('model_type')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label>
                  Cost
                  <span class="text-danger">*</span>
                </label>
                <input
                  type="number"
                  class="form-control form-control-sm @error('cost') is-invalid @enderror"
                  name="cost"
                  min="0"
                  step="0.01"
                  value="{{ old('cost') }}"
                  required
                />

                @error('cost')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label>
                  Quantity
                  <span class="text-danger">*</span>
                </label>
                <input
                  type="number"
                  class="form-control form-control-sm @error('quantity') is-invalid @enderror"
                  name="quantity"
                  min="1"
                  value="{{ old('quantity') }}"
                  required
                />

                @error('quantity')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Specification</label>
                <input type="text" class="form-control form-control-sm" name="specification" value="{{ old('specification') }}" />
              </div>

              <div class="form-group col-md-4">
                <label>
                  Supplier
                  <span class="text-danger">*</span>
                </label>
                <select class="form-control form-control-sm @error('supplier') is-invalid @enderror" name="supplier" required>
                  <option value="" disabled {{ old('supplier') ? '' : 'selected' }}>Select</option>
                  <option value="Lazada" {{ old('supplier') === 'Lazada' ? 'selected' : '' }}>Lazada</option>
                  <option value="Thinking Tools" {{ old('supplier') === 'Thinking Tools' ? 'selected' : '' }}>Thinking Tools</option>
                </select>

                @error('supplier')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label>
                  Purchase Date
                  <span class="text-danger">*</span>
                </label>
                <input
                  type="month"
                  class="form-control form-control-sm @error('purchase_date') is-invalid @enderror"
                  name="purchase_date"
                  value="{{ old('purchase_date') }}"
                  required
                />

                @error('purchase_date')
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
