@extends('layouts.dashboard.app')
<?php
$page="subcategories";
$title=trans('site.subcategories');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.subcategories')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.subcategories.index') }}"> @lang('site.subcategories')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.subcategories.update', $subcategory->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        

                        @foreach (config('translatable.locales') as $key=> $locale)
                        
                            <div class="form-group">
                                    <!-- <span class="label label-warning  ">{{$key+1}}  </span>   -->
                                <label>@lang('site.' . $locale .'.description')</label>
                                <input   type="text" name="{{ $locale }}[name]" class="form-control"  required="required"  value="{{ $subcategory->translate($locale)->name }}">
                            </div>
                            
                            </div>
                            
                        @endforeach 

                        <div class="form-group">
                            <label>@lang('site.category')</label>
                            <select name='category_id'  id = 'category_id' class="form-control" required >
                                <option value="">@lang('site.category')</option>
                                @foreach( $categories as $item )
                                <option value="{{ $item->id}}" @if( old('category_id') == $item->id  || $subcategory->category_id == $item->id  ) selected  @endif > {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>


        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')


<script type="text/javascript">  

    $(function () {  
        $("#buttonAdd").bind("click", function () {  
            var div = $("<div />");  
            div.html(GenerateTextbox(""));  
            $("#TextBoxContainer").append(div);  
        });  
        
        $("body").on("click", ".remove", function () {  
            $(this).closest("div").remove();  
        });  
    });  

    function GenerateTextbox() {  

        return '<div class="form-group"> <input name = "bundle[]" type="text" value = "" required autofocus placeholder = "bundle name" /> ' +
            '<input name = "price[]" type="text" value = "" required autofocus  placeholder= "price"  /> '+  
            '<input type="button" value="Remove" class="remove"  /></div>'  ;  
    }

</script> 
@endsection
