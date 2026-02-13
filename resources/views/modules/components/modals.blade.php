<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Checkout Component</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form id="checkoutForm">
        <div class="modal-body">
          <!-- hidden id -->
          <input type="hidden" id="checkout_id" name="component_id" />

          <div class="form-group">
            <label for="employee">Employees</label>
            <select class="form-control" name="employee" id="employee" required>
              <option value="" selected disabled>Select Employee</option>
              <!-- dynamically populate options via JS or backend -->
            </select>
          </div>

          <div class="form-group">
            <label for="checkout_date">Checkout Date</label>
            <input type="date" class="form-control" name="checkout_date" id="checkout_date" required />
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="component_name">Component Name</label>
              <input type="text" class="form-control" name="component_name" id="component_name" readonly />
            </div>

            <div class="form-group col-md-6">
              <label for="checkout_qty">Quantity</label>
              <input type="number" class="form-control" name="checkout_qty" id="checkout_qty" min="1" value="1" />
            </div>
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
