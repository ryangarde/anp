<div class="modal fade" id="retail" tabindex="-1" role="dialog" aria-labelledby="retailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="retailModalLabel">

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/products/{{ $product->id }}/retail" method="POST">
          {{ csrf_field() }}
          <div class="form-group col-md-6">
              <label for="price">Price</label>
              <input type="text" class="form-control" name="price" id="price" autocomplete="off" value="{{ old('price') }}" required>
              @if ($errors->has('price'))
              <span class="help-block">
                  <strong>{{ $errors->first('price') }}</strong>
              </span>
              @endif
          </div>
          <div class="form-group col-md-6">
            <label for="retail_size_id">Retail Size</label>
            <select class="form-control" id="retail_size_id" name="retail_size_id">
                @foreach ($retailSizes as $retailSize)
                <option value="{{ $retailSize->id }}">{{ $retailSize->name }}</option>
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
          <button type="submit" class="btn btn-primary" style="cursor: pointer;">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
