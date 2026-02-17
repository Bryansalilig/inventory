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
        <div class="col-md-8">
          <h3>Component Stock Detail</h3>
        </div>
        <div class="col-md-4 text-md-right">
          <a href="{{ route('components.stocks.index', $component) }}" class="btn btn-light btn-sm">
            <i class="fa fa-chevron-left"></i>
            Back
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-md-9">
                  <p class="title-detail font-bold">
                    {{ $component->name . ' ' . '(' . $component->asset_tag . ')' }}
                  </p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#details">Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#maintenance">Maintenances</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#history">History</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- DETAILS TAB -->
                    <div class="tab-pane fade show active" id="details">
                      <div class="row pt-3">
                        <div class="col-md-9">
                          <table class="table table-hover" id="stockDetailTable" data-url="{{
                            route('components.stocks.stockDetail', [
                              'component' => $component->id,
                              'stock' => $stock->id,
                            ])
                          }}">
                            <tr>
                              <td width="200" bgcolor="#f2f3f4"><b>Model Type</b></td>
                              <td id="model_type">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Cost</b></td>
                              <td id="cost">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Quantity</b></td>
                              <td id="quantity">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Available Item</b></td>
                              <td id="available_component">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Specification</b></td>
                              <td id="specification">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Supplier</b></td>
                              <td id="supplier">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Purchase Date</b></td>
                              <td id="purchase_date">Loading...</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f2f3f4"><b>Created At</b></td>
                              <td id="created_at">Loading...</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>

                    <!-- MAINTENANCE TAB -->
                    <div class="tab-pane fade" id="maintenance">
                      <div class="table-responsive pt-4">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- HISTORY TAB -->
                    <div class="tab-pane fade" id="history">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-bordered"
                          id="historyTable"
                          data-url="{{
                            route('components.stocks.history', [
                              'component' => $component->id,
                              'stock' => $stock->id,
                            ])
                          }}"
                          width="100%"
                        >
                          <thead>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Asset Tag</th>
                              <th>Deployed To</th>
                              <th>Quantity</th>
                              <th>Created By</th>
                              <th>Created At</th>
                            </tr>
                          </tbody>
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

  <!-- Checkout Modal -->
  {{-- @include('modules.components.modals') --}}
@endsection

{{-- Load page specific scripts --}}
@include('modules.components.stocks.scripts')
