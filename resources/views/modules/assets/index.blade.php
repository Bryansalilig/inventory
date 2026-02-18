@extends('layouts.main')

@section('title', 'Assets')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
@endpush

@section('content')
  <section>
    <div class="content p-4">
      <div class="row">
        <div class="col-md-6">
          <h3>Asset List</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="assetTable" width="100%">
                  <thead>
                    <tr>
                      <th>Picture</th>
                      <th>Name</th>
                      <th>Model Type</th>
                      <th>Asset Tag</th>
                      <th>Deployed To</th>
                      <th>Employee Position</th>
                      <th>Deployed Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Picture</th>
                      <th>Name</th>
                      <th>Model Type</th>
                      <th>Asset Tag</th>
                      <th>Deployed To</th>
                      <th>Employee Position</th>
                      <th>Deployed Date</th>
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
@endsection

{{-- Load page specific scripts --}}
@include('modules.assets.scripts')
