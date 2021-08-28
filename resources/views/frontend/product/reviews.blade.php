<div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
    <div class="comments mt-3">
        @foreach ($product->reviews as $review)
            <div class="items__comment row no-gutters align-content-center p-3">
                <div class="img__comment col-md-2">
                    <img src="{{ $review->customer->image_path }}" class="img-fluid" alt="Image">
                </div>
                <div class="info__comment col-md-10">
                    <div class="mb-2 d-flex align-items-center justify-content-between">
                        <div class="user__name">
                            <strong class="h4 mb-0 d-block">{{ $review->customer->full_name }}</strong>
                            <div class="ratings mt-3">
                                @for ($i = 0; $i < $review->review; $i++)
                                    <i class="fa fa-star fa-xs active"></i>
                                @endfor

                                @for ($j = $i; $i < 5; $i++)
                                    <i class="fa fa-star fa-xs"></i>
                                @endfor

                            </div>
                        </div>
                        <span class="date d-block">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="p-0 m-0">
                        {!! $review->comment !!}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <!--title start-->
    <div class="title4 section-my-space">
        <h4>Add Your <span>Comment</span></h4>
    </div>
    <!--title end-->
    <form action="{{ route('customer.add_review') }}" method="post" class="theme-form">
        {{ csrf_field() }}
        {{ method_field('post') }}
        <input type='hidden' name='product_id' value="{{ $product->id }}">

        <div class="row g-3">
            <div class="col-md-12">
                <div class="media d-block">
                    <label for="">@lang('site.Your Rate')</label>
                    <select name='review' class='form-control'>
                        <option value="1"> {{ __('site.1 Star') }} </option>
                        <option value="2"> {{ __('site.2 Star') }} </option>
                        <option value="3"> {{ __('site.3 Star') }} </option>
                        <option value="4"> {{ __('site.4 Star') }} </option>
                        <option value="5"> {{ __('site.5 Star') }} </option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label>Review Comment</label>
                <textarea  name='comment' class="form-control" placeholder="Wrire Your Testimonial Here" rows="6"></textarea>
            </div>
            <div class="col-md-12">
                <button class="btn btn-normal" type="submit">Submit Your Review</button>
            </div>
        </div>
    </form>

</div>
