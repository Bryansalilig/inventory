@extends('layouts.main')

@section('title', 'Employees')

@push('styles')
  {{-- @include('modules.components.styles') --}}
  <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
@endpush

@section('content')
  <section>
    <div class="content p-4">
      <div class="row">
        <div class="col-md-6">
          <h3>Employee List</h3>
        </div>
        {{--
          <div class="col-md-6 text-md-right pb-md-0 pb-3">
          <a href="{{ route('components.create') }}" class="btn btn-sm btn-fill btn-primary">
          <i class="fa fa-plus"></i>
          Add Component
          </a>
          </div>
        --}}
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="employeeTable" width="100%">
                  <thead>
                    <tr>
                      <th>Employee Name</th>
                      <th>Cubicle</th>
                      <th>CPU</th>
                      <th>Keyboard</th>
                      <th>Mouse</th>
                      <th>Headset</th>
                      <th>Monitor</th>
                      <th>Camera</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Employee Name</th>
                      <th>Cubicle</th>
                      <th>CPU</th>
                      <th>Keyboard</th>
                      <th>Mouse</th>
                      <th>Headset</th>
                      <th>Monitor</th>
                      <th>Camera</th>
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
@include('modules.employees.scripts')
