@extends('core::admin.'.$theme_cms->value.'.templates.parent')

@section('page_level_css')
    {{Html::style(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'))}}
    {{Html::style(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'))}}
@endsection

@section('title_dashboard', 'Page')

@section('breadcrumb')
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="#" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Home</span>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Page</span>
                </a>
            </li>
        </ul>
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">

        <form class="m-form m-form--fit m-form--label-align-right" action="{{action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@store')}}" method="post" enctype="multipart/form-data">
            <!--begin::Portlet-->
            <div class="row">
                <div class="col-md-8">
                    <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-wrapper">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Post Form
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--begin::Form-->
                            <div class="m-portlet__body">
                                <div class="col-md-9 offset-md-3">
                                    @if (!empty(session('global_message')))
                                        <div class="alert {{session('global_message')['status'] == 200 ? 'alert-info' : 'alert-warning' }}">
                                            {{session('global_message')['message']}}
                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group m-form__group d-flex px-0">
                                    <div class="col-3 d-flex justify-content-end py-3">
                                        <label for="exampleInputEmail1">Page Title<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control m-input slugify" data-target="slug" placeholder="Page Title" name="post[post_title]" value="{{old('post.post_title') ? old('post.post_title') : (!empty($post) ? $post->post_title : '')}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group d-flex px-0">
                                    <div class="col-3 d-flex justify-content-end py-3">
                                        <label for="exampleInputEmail1">Page Slug<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control m-input" id="slug" placeholder="Page Slug" name="post[post_slug]" value="{{old('post.post_slug') ? old('post.post_slug') : (!empty($post) ? $post->post_slug : '')}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group d-flex px-0">
                                    <div class="col-12">
                                        <textarea class="form-control m-input texteditor" placeholder="Page Content" name="post[post_content]">{{old('post.post_content') ? old('post.post_content') : (!empty($post) ? $post->post_content : '')}}</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="post[post_excerpt]" value="{{old('post.post_excerpt') ? old('post.post_excerpt') : (!empty($post) ? $post->post_excerpt : '')}}">
                            </div>
                            {{csrf_field()}}
                            @if(isset($_GET['code']))
                                <input type="hidden" name="id" value="{{$_GET['code']}}">
                            @endif
                            {{$method}}

                        <!--end::Form-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-12 px-0">
                        <div class="m-portlet m-portlet--tab">
                            <!--begin::Form-->
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon m--hide">
                                                <i class="fa fa-gear"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                                Options
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body px-0">
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-7 d-flex">
                                            <label for="exampleInputEmail1">Publish Page<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                                        </div>
                                        <div class="col-5">
                                            <span class="m-switch m-switch--icon m-switch--danger">
                                                <label>
                                                    <input type="checkbox" {{old('post.post_status') ? 'checked' : ((!empty($post) && $post->post_status == 'publish' ? 'checked' : ''))}} name="post[post_status]">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-7 d-flex">
                                            <label for="exampleInputEmail1">Open Comment<span class="ml-1 m--font-danger" aria-required="true">*</span></label>
                                        </div>
                                        <div class="col-5">
                                            <span class="m-switch m-switch--icon m-switch--danger">
                                                <label>
                                                    <input type="checkbox" {{old('post.comment_status') ? 'checked' : ((!empty($post) && $post->comment_status == 'close' ? '' : 'checked'))}} name="post[comment_status]">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <!--end::Form-->
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="m-portlet m-portlet--tab">
                            <!--begin::Form-->
                                <div class="m-portlet__body px-0">
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-12 d-flex py-3">
                                            <label for="exampleInputEmail1">Meta Title</label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control m-input" placeholder="Meta Title" name="meta[meta_title]" value="{{old('meta.meta_title') ? old('meta.meta_title') : (!empty($post) && $post->postMeta->where('meta_key', 'meta_title')->first() ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : '')}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-12 d-flex py-3">
                                            <label for="exampleInputEmail1">Meta Keyword</label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control m-input" placeholder="Meta Keyword" name="meta[meta_keyword]" value="{{old('meta.meta_keyword') ? old('meta.meta_keyword') : (!empty($post) && $post->postMeta->where('meta_key', 'meta_keyword')->first() ? $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value : '')}}" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-12 d-flex py-3">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control m-input autosize" placeholder="Meta Description" name="meta[meta_description]">{{old('meta.meta_description') ? old('meta.meta_description') : (!empty($post) && $post->postMeta->where('meta_key', 'meta_description')->first() ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : '')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            <!--end::Form-->
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="m-portlet m-portlet--tab">
                            <!--begin::Form-->
                                <div class="m-portlet__body px-0">
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-12 d-flex py-3">
                                            <label for="exampleInputEmail1">Parent</label>
                                        </div>
                                        <div class="col-12">
                                            <select name="post[post_parent]" class="form-control m-input m-input--solid">
                                                <option value="" selected>-- Non Group --</option>
                                                @foreach ($parents as $parent)
                                                    <option value="{{$parent->id}}" {{old('post.post_parent') && old('post.post_parent') == $parent->id ? 'selected' : (!empty($post) && $post->post_parent == $parent->id ? 'selected' : '')}}>-- {{ucfirst($parent->post_title)}} --</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-12 d-flex py-3">
                                            <label for="exampleInputEmail1">Menu Order</label>
                                        </div>
                                        <div class="col-12">
                                            <input type="number" class="form-control m-input" name="post[menu_order]" min="0" value="{{old('post.menu_order') ? old('post.menu_order') : (!empty($post) ? $post->menu_order : 0)}}" placeholder="Menu Order">
                                        </div>
                                    </div>
                                </div>
                            <!--end::Form-->
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="m-portlet m-portlet--tab">
                            <!--begin::Form-->
                                <div class="m-portlet__body px-0">
                                    <div class="form-group m-form__group d-flex px-0 flex-wrap">
                                        <div class="col-12 d-flex py-3">
                                            <label for="exampleInputEmail1">Feature Image</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                        <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                    @else
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn btn-file btn-accent m-btn m-btn--air m-btn--custom">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="meta[feature_image]"> </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </form>

    </div>
</div>
{{-- End of Row --}}

@endsection

@section('page_level_js')
    {{Html::script(module_asset_url('core:assets/js/autosize.min.js'))}}
    {{Html::script(module_asset_url('core:assets/js/slugify.js'))}}
    {{Html::script(module_asset_url('core:assets/metronic-v5/global/plugins/ckeditor_4/ckeditor.js'))}}
    {{Html::script(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'))}}
    {{Html::script(module_asset_url('core:assets/metronic-v5/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'))}}
@endsection