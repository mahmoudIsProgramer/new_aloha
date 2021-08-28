<a href="" data-toggle="modal" data-target="#modal-trips{{$value->id}}">
  <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i></button>
</a>

<div class="modal fade" id="modal-trips{{$value->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> {{$value->title}}</h4>
      </div>
      <div class="modal-body">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <h3 class="profile-username text-center">{{$value->name}}</h3>

            <p class="text-muted text-center">@lang('site.Create since')
              {{date('M-Y',strtotime($value->created_at))}}</p>

            <ul class="list-group list-group-unbordered">


              {{-- <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5"
                    aria-hidden="true"></i>@lang('site.number_views')</b>
                <a class="pull-right">
                  {!! $value->number_views !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5" aria-hidden="true"></i>@lang('site.hot_deal')</b>
                <a class="pull-right">
                  {!! activeColumn($value->hot_deal)!!}
                </a>
              </li>

               @if($value->hot_deal==1)
              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5"
                    aria-hidden="true"></i>@lang('site.hot_deal_price')</b>
                <a class="pull-right">
                  {!! $value->hot_deal_price !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5"
                    aria-hidden="true"></i>@lang('site.expire_date_hot_deal')</b>
                <a class="pull-right">
                  {{ date("Y-m-d",strtotime($value->expire_date_hot_deal)) }}
                </a>
              </li>

              @endif --}}

              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5"
                    aria-hidden="true"></i>@lang('site.product_code')</b>
                <a class="pull-right">
                  {!!$value->product_code!!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5"
                    aria-hidden="true"></i>@lang('site.porduct_sku_code')</b>
                <a class="pull-right">
                  {!!$value->porduct_sku_code!!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5"
                    aria-hidden="true"></i>@lang('site.short_description')</b>
                <a class="pull-right">
                  {!!$value->short_description!!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-user margin-r-5" aria-hidden="true"></i>@lang('site.description')</b>
                <a class="pull-right">
                  {!!$value->description!!}
                </a>
              </li>

              <label for="">{{ __('site.images') }}</label>
              @foreach($value->productImages as $item)
              <li class="list-group-item">
                <img src="{{ $item->image_path }}" style="width: 20000px;" class="img-thumbnail" alt="">
              </li>
              @endforeach

            </ul>
          </div>


          <!-- /.box-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left"
          data-dismiss="modal">@lang('site.Close')</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
