<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-keyboard="true" data-ride="true">
  <ol class="carousel-indicators">
    @foreach($product->images as $index => $image)
        @if (! empty($image->image))
          <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
        @endif
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach($product->images as $index => $image)
        @if (! empty($image->image))
          <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <a href="{{ asset('storage/images/'. $image->image)  }}" style="cursor: zoom-in;">
              <img class="d-block w-100 shop-img-show" src="{{ asset('storage/images/'. $image->image)  }}" alt="Card image cap">
            </a>
          </div>
        @endif
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
