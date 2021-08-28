<a href="" data-toggle="modal" data-target="#modal-package{{$package->id}}">
  <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i> {!!
    $package->name !!}</button>
</a>

<div class="modal fade" id="modal-package{{$package->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="box box-primary">
          <div class="box-body box-profile">

            <ul class="list-group list-group-unbordered">

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.name')</b>
                <a class="pull-right">
                  {!! $package->name !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.sale_price')</b>
                <a class="pull-right">
                  {!! $package->sale_price !!}
                </a>
              </li>

              {{-- <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.email')</b>
                <a class="pull-right">
                  {!! $package->email !!}
                </a>
              </li> --}}
{{--
              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.image')</b><br>
                <img src="{{ $package->image_path }}" style="width: 300px;height:200px" class="img-thumbnail" alt="">
              </li> --}}

            </ul>
          </div>


          <!-- /.box-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('site.Close')</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
