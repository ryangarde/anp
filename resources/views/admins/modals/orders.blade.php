<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel">
          {{ $order->user->name }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Email:</b> {{ $order->user->email }}<br>
        <b>Phone Number:</b> {{ $order->user->phone_number }}<br>
        <b>Lot/Block No.:</b> {{ $order->user->lot_block }}<br>
        <b>Street:</b> {{ $order->user->street }}<br>
        <b>Subdivision/Barangay:</b> {{ $order->user->subdivision_barangay }}<br>
        <b>City/Municipality:</b> {{ $order->user->city_municipality }}<br>
        <b>Province:</b> {{ $order->user->province }}<br>
        <b>Zip Code:</b> {{ $order->user->zip_code }}<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
      </div>
    </div>
  </div>
</div>
