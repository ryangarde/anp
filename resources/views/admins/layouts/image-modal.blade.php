<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/products/{{ $product->id }}/image" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image" autocomplete="off" >
            @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
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
