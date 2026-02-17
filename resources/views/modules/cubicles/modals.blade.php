<div class="modal fade" id="cubicleModal" tabindex="-1" role="dialog" aria-labelledby="cubicleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cubicleModalLabel">Add Cubicle</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form id="cubicleForm">
        <div class="modal-body">
          <!-- hidden id -->
          <div class="form-group">
            <label for="location">Location</label>
            <select class="form-control" name="location" id="location" required>
              <option value="" disabled selected>Select Location</option>
              <option value="1">First Floor (1)</option>
              <option value="2">Second Floor (2)</option>
              <option value="3">Third Floor (3)</option>
              <option value="4">Fourth Floor (4)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="name">Cubicle Name</label>
            <select class="form-control" name="name" id="name" required>
              <option value="" disabled selected>Select Cubicle Name</option>
              <option value="C">Cubicle (C)</option>
              <option value="T">Table (T)</option>
              <option value="MT">Manager Table (MT)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="last_cubicle">Last Cubicle</label>
            <input type="text" class="form-control" id="last_cubicle" readonly />
          </div>

          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" value="1" />
            <span id="stock-message" class="text-danger"></span>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Confirm Checkout</button>
        </div>
      </form>
    </div>
  </div>
</div>
