<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel">
          {{ $user->name }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Email:</b> {{ $user->email }}<br>
        <b>Phone Number:</b> {{ $user->phone_number }}<br>
        <b>Lot/Block No.:</b> {{ $user->lot_block }}<br>
        <b>Street:</b> {{ $user->street }}<br>
        <b>Subdivision/Barangay:</b> {{ $user->subdivision_barangay }}<br>
        <b>City/Municipality:</b> {{ $user->city_municipality }}<br>
        <b>Province:</b> {{ $user->province }}<br>
        <b>Zip Code:</b> {{ $user->zip_code }}<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
      </div>
    </div>
  </div>
</div>
