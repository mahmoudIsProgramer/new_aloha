<a href="" data-toggle="modal" data-target="#modal-value{{$value->id}}">
  <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i> {!!
    $value->full_name !!}</button>
</a>

<div class="modal fade" id="modal-value{{$value->id}}">
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
                  {!! $value->full_name !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.phone')</b>
                <a class="pull-right">
                  {!! $value->phone !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.email')</b>
                <a class="pull-right">
                  {!! $value->email !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.company_name')</b>
                <a class="pull-right">
                  {!! $value->company_name !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.company_address')</b>
                <a class="pull-right">
                  {!! $value->company_address !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.job_title')</b>
                <a class="pull-right">
                  {!! $value->job_title !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.address')</b>
                <a class="pull-right">
                  {!! $value->address !!}
                </a>
              </li>
              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.tax_no')</b>
                <a class="pull-right">
                  {!! $value->tax_no !!}
                </a>
              </li>
              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.commerical_no')</b>
                <a class="pull-right">
                  {!! $value->commerical_no !!}
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.commerical_image')</b><br>

                <a data-fancybox="gallery" href="{{ $value->commerical_image_path }}">
                  <img src="{{ $value->commerical_image_path }}" style="width: 300px;height:200px" class="img-thumbnail"
                    alt="">
                </a>
              </li>

              <li class="list-group-item">
                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                  @lang('site.tax_image')</b><br>

                <a data-fancybox="gallery" href="{{ $value->tax_image_path }}">
                  <img src="{{ $value->tax_image_path }}" style="width: 300px;height:200px" class="img-thumbnail"
                    alt="">
                </a>
              </li>

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
