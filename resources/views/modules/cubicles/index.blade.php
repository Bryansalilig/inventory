@extends('layouts.main')

@section('title', 'Components')

@push('styles')
  {{-- @include('modules.components.styles') --}}
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
@endpush

@section('content')
  <section>
    <div class="content p-4">
      <div class="row">
        <div class="col-md-6">
          <h3>Cubicle Floor List</h3>
        </div>
        <div class="col-md-6 text-md-right pb-md-0 pb-3">
          <a href="#" class="btn btn-sm btn-fill btn-primary" data-toggle="modal" data-target="#cubicleModal">
            <i class="fa fa-plus"></i>
            Add Cubicle
          </a>
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
                      <a class="nav-link active" data-toggle="tab" href="#hr_floor">HR Floor</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#first_floor">First Floor (1)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#second_floor">Second Floor (2)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#third_floor">Third Floor (3)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#fourth_floor">Fourth Floor (4)</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- HR Floor TAB -->
                    <div class="tab-pane fade show active" id="hr_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="HRFloorTable" data-url="{{ route('cubicles.getCubicles', 1) }}">
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

                    <!-- First Floor TAB -->
                    <div class="tab-pane fade" id="first_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="firstFloorTable" data-url="{{ route('cubicles.getCubicles', 2) }}" width="100%">
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

                    <!-- Second Floor TAB -->
                    <div class="tab-pane fade" id="second_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="secondFloorTable" data-url="{{ route('cubicles.getCubicles', 3) }}" width="100%">
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

                    <!-- Third Floor -->
                    <div class="tab-pane fade" id="third_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="thirdFloorTable" data-url="{{ route('cubicles.getCubicles', 4) }}" width="100%">
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

                    <!-- Fourth Floor -->
                    <div class="tab-pane fade" id="fourth_floor">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="fourthFloorTable" data-url="{{ route('cubicles.getCubicles', 5) }}" width="100%">
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
  @include('modules.cubicles.modals')
@endsection

{{-- Load page specific scripts --}}
@include('modules.cubicles.scripts')
