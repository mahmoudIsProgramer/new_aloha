<div class="col-sm-3 collection-filter category-page-side">

    <form action="{{ route('products') }}" method="GET">
        {{-- @foreach (request()->query() as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach --}}

        <input type="hidden" name="perPage" value="{{ request()->perPage }}">

        <!-- side-bar colleps block stat -->
        <div class="collection-filter-block creative-card creative-inner category-side">
            <!-- brand filter start -->
            <div class="collection-mobile-back">
                <span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i>
                    back</span>
            </div>
            <div class="collection-collapse-block open">
                <h3 class="collapse-block-title mt-0">brand</h3>
                <div class="collection-collapse-block-content">
                    <div class="collection-brand-filter">
                        @foreach ($brands as $value)
                            <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                <input type="checkbox" name="brand_id[]" value="{{ $value->id }}"
                                    @if (in_array($value->id, (array)request('brand_id') )) checked @endif class="custom-control-input form-check-input"
                                    id="{{ $value->id }}">
                                <label class="custom-control-label form-check-label"
                                    for="{{ $value->id }}">{{ $value->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- price filter start here -->
            <div class="collection-collapse-block border-0 open">
                <h3 class="collapse-block-title">price</h3>
                <div class="collection-collapse-block-content">
                    <div id="Range_price" class="range-slider">
                        <input value="{{ request()->from_price ?? 0 }}" min="0" max="{{ maxPrice() }}"
                            step="{{ stepValue() }}" type="range" />
                        <input value="{{ request()->to_price ?? maxPrice() }}" min="0" max="{{ maxPrice() }}"
                            step="{{ stepValue() }}" type="range" />
                        <div>
                            <span class="pull-left">
                                <!-- <label>From : </label> -->
                                <input type="number" name='from_price' value="{{ request()->from_price ?? 0 }}"
                                    min="0" max="{{ maxPrice() }}" />
                            </span>
                            <span class="pull-right">
                                <!-- <label>To : </label> -->
                                <input type="number" name='to_price' value="{{ request()->to_price ?? maxPrice() }}"
                                    min="0" max="{{ maxPrice() }}" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn-filter" value="Search">
        <!-- silde-bar colleps block end here -->
    </form>


    <div class="collection-sidebar-banner">
        <a href="javascript:void(0)"><img src="{{ asset('frontend/') }}/assets/imgs/side-banner.png"
                class="img-fluid " alt=""></a>
    </div>

</div>
