<div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="employeeForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="employeeModalLabel">Assign Employee</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="employee_id" id="employee_id" />
          <div class="mb-3">
            <label for="employee" class="form-label">Employees</label>
            <select class="select2" name="employee" id="employee"></select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="cubicleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="cubicleForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="cubicleModalLabel">Cubicles</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id" />
          <h4 id="employee_name"></h4>
          <div class="mb-3">
            <label for="cubicle" class="form-label">Select Cubicle</label>
            <select class="select2" name="cubicle" id="cubicle">
              <option value=""></option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
