<div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quantityModalLabel">
          Shop
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="quantity">Enter quantity</label>
          <input type="number" class="form-control" name="quantity" id="quantity" min="1" autocomplete="off" value="{{ old('quantity') }}" required>
          @if ($errors->has('quantity'))
          <span class="help-block">
              <strong>{{ $errors->first('quantity') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="retail_size_id">Retail Size</label>
          <select class="form-control" id="retail_size_id" name="retail_size_id">
              @foreach ($product->productRetailSizes as $retailSize)
              <option value="{{ $retailSize->retailSize->id }}">{{ $retailSize->retailSize->name }}</option>
              @endforeach
          </select>
          @if ($errors->has('retail_size_id'))
          <span class="help-block">
              <strong>{{ $errors->first('retail_size_id') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn add-to-cart-button anp-btn" style="cursor: pointer;">Buy now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
      </div>
    </div>
  </div>
</div>
