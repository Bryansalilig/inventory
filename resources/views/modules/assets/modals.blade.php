<div class="modal fade" id="maintenanceModal" tabindex="-1" role="dialog" aria-labelledby="maintenanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="maintenanceModalLabel">Move to Maintenance</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form id="maintenanceForm">
        @csrf
        <div class="modal-body">
          <!-- hidden id -->
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="component_id" id="component_id" />
          <input type="hidden" name="component_stock_id" id="component_stock_id" />
          <input type="hidden" name="employee_id" id="employee_id" />
          <input type="hidden" name="asset_tag" id="asset_tag" />
          <h4 id="display_name"></h4>
          <h6 id="display_model_type"></h6>
          <h6 id="display_asset_tag"></h6>

          <hr />

          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="20" rows="5"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Move</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignModalLabel">Assign</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form id="assignForm">
        @csrf
        <div class="modal-body">
          <!-- hidden id -->
          <input type="hidden" name="assign_asset_tag" id="assign_asset_tag" />
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="component_id" id="component_id" />
          <h4 id="d_name"></h4>
          <h6 id="d_model_type"></h6>
          <h6 id="d_asset_tag"></h6>

          <hr />

          <div class="form-group">
            <label for="employee">Employees</label>
            <select class="select2" name="employee" id="employee"></select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
