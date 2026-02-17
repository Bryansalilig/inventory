@extends('layouts.main')

@section('title', 'Components')

@push('styles')
  {{-- @include('modules.components.styles') --}}
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
@endpush

@section('content')
  <section>
    <div class="content p-4">
      <div class="row pt-3">
        <div class="col-md-6">
          <h3>Component Stock List</h3>
        </div>
        <div class="col-md-6 text-md-right pb-md-0 pb-3">
          <a href="{{ route('components.stocks.create', $component) }}" class="btn btn-sm btn-fill btn-primary">
            <i class="fa fa-plus"></i>
            Add Stock
          </a>
          <a href="{{ route('components.index') }}" class="btn btn-light btn-sm">
            <i class="fa fa-chevron-left"></i>
            Back
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <h4>{{ $component->name . ' ' . '(' . $component->asset_tag . ')' }}</h4>
                <table class="table table-striped table-bordered" id="assetTable" data-url="{{ route('components.stocks.data', $component) }}" width="100%">
                  <thead>
                    <tr>
                      <th>Model Type</th>
                      <th>Cost</th>
                      <th>Qty / Avail</th>
                      <th>Specification</th>
                      <th>Supplier</th>
                      <th>Purchase Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Model Type</th>
                      <th>Cost</th>
                      <th>Qty / Avail</th>
                      <th>Specification</th>
                      <th>Supplier</th>
                      <th>Purchase Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Check out modal --}}
  @include('modules.components.stocks.modals')
@endsection

{{-- Load page specific scripts --}}
@include('modules.components.stocks.scripts')
