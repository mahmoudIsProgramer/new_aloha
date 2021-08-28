<a href="" data-toggle="modal" data-target="#modal-customer{{ $customer->id }}">
    <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i> {!! $customer->full_name !!}</button>
</a>

<div class="modal fade" id="modal-customer{{ $customer->id }}">
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
                                    {!! $customer->full_name !!}
                                </a>
                            </li>

                            <li class="list-group-item">
                                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                                    @lang('site.phone')</b>
                                <a class="pull-right">
                                    {!! $customer->phone !!}
                                </a>
                            </li>

                            <li class="list-group-item">
                                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                                    @lang('site.email')</b>
                                <a class="pull-right">
                                    {!! $customer->email !!}
                                </a>
                            </li>


                            <li class="list-group-item">
                                <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>
                                    @lang('site.image')</b><br>
                                <img src="{{ $customer->image_path }}" style="width: 300px;height:200px"
                                    class="img-thumbnail" alt="">
                            </li>

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
</div>
