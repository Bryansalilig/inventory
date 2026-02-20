@extends('layouts.main')

@section('title', 'Maintenance')

@push('styles')
  @include('modules.maintenance.styles')
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
@endpush

@section('content')
  <section>
    <div class="content p-4">
      <div class="row">
        <div class="col-md-6">
          <h3>Maintenance List</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#maintenance">Maintenance</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#repaired">Ready to Deploy</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#dispossal">Dispossal</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- Maintenance TAB -->
                    <div class="tab-pane fade show active" id="maintenance">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="maintenanceTable" data-url="{{ route('maintenance.getData', 'Maintenance') }}">
                          <thead>
                            <tr>
                              <th>Picture</th>
                              <th>Name</th>
                              <th>Asset Tag</th>
                              <th>Model Type</th>
                              <th>Status</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>Picture</th>
                              <th>Name</th>
                              <th>Asset Tag</th>
                              <th>Model Type</th>
                              <th>Status</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>

                    <!-- Ready to deploy TAB -->
                    <div class="tab-pane fade" id="repaired">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="repairedTable" data-url="{{ route('maintenance.getData', 'Repaired') }}" width="100%">
                          <thead>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>

                    <!-- Dispossal TAB -->
                    <div class="tab-pane fade" id="dispossal">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dispossalTable" data-url="{{ route('maintenance.getData', 'Dispossal') }}" width="100%">
                          <thead>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>Cubicle Name</th>
                              <th>Stutus</th>
                              <th>Assigned To</th>
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
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Modals --}}
  {{-- @include('modules.cubicles.modals') --}}
@endsection

{{-- Load page specific scripts --}}
@include('modules.maintenance.scripts')
