<ul class="nav flex-column background py-1 sidebar-nav">
    <li class="nav-item">
        <span class="nav-link">Filter By</span>
    </li>

    <div class="container-fluid">
        <form action="{{ $searchUrl }}" method="POST" accept-charset="utf-8">
            {{ csrf_field() }}
            {{ method_field('GET') }}

            <div class="form-group">
                <label for="searchColumnName text-color">Name</label>
                <input type="search" class="form-control form-control-sm" id="searchColumnName" name="searchColumnName" placeholder="Search Name" value="{{ request()->searchColumnName }}" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="searchColumnDescription">Description</label>
                <input type="search" class="form-control form-control-sm" id="searchColumnDescription" name="searchColumnDescription" placeholder="Search Description" value="{{ request()->searchColumnDescription }}" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="searchProducers">Producers</label>
                <div style="max-height: 100px; overflow-y: scroll;">
                    @if (! empty(request()->searchArrayColumnNameFromModelProducer))
                        @foreach ($producers as $producer)
                            @foreach (request()->searchArrayColumnNameFromModelProducer as $filterProducer)
                                @if ($producer->name == $filterProducer)
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="searchArrayColumnNameFromModelProducer[]" value="{{ $producer->name }}" checked="true"> {{ $producer->name }}
                                    </label>
                                </div>
                                @else
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="searchArrayColumnNameFromModelProducer[]" value="{{ $producer->name }}"> {{ $producer->name }}
                                    </label>
                                </div>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        @foreach ($producers as $producer)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="searchArrayColumnNameFromModelProducer[]" value="{{ $producer->name }}"> {{ $producer->name }}
                            </label>
                        </div>
                        @endforeach
                    @endif


                    {{-- @foreach ($producers as $producer)

                    @if (! empty(request()->searchArrayColumnNameFromModelProducer))
                        @foreach (request()->searchArrayColumnNameFromModelProducer as $filterProducer)
                            @if ($producer->name == $filterProducer)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="searchArrayColumnNameFromModelProducer[]" value="{{ $producer->name }}" checked="true"> {{ $producer->name }}
                                </label>
                            </div>
                            @else
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="searchArrayColumnNameFromModelProducer[]" value="{{ $producer->name }}"> {{ $producer->name }}
                                </label>
                            </div>
                            @endif
                        @endforeach
                    @endif

                    @endforeach --}}
                </div>
            </div>

            <div class="form-group">
                <label for="searchCategories">Categories</label>
                <div style="max-height: 100px; overflow-y: scroll;">
                    @foreach ($categories as $category)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="searchArrayColumnNameFromModelCategory[]" value="{{ $category->name }}"> {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="searchColumnPrice">Price ₱1 - ₱10000</label>
                <input id="price-slider" type="text" class="span2" value="" data-slider-min="1" data-slider-max="10000" data-slider-step="1" data-slider-value="[1,10000]">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-theme-color btn-sm anp-btn">Filter</button>
            </div>
        </form>
    </div>
</ul>

<br>
