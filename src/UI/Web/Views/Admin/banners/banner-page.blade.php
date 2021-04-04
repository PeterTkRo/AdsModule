@extends('admin.layout')

@section('content')
    @php
        $module_configuration = new App\Models\ModulesConfiguration;
    @endphp

    @include('admin.buttons-group', [
        'buttons_group' => array(
            array(
                'class' => 'blue',
                'onclick' => 'invalidFieldsSubmitButton()',
                'form' => 'single-banner-form',
                'icon_class' => 'add_items',
                'text' => __('admin.save'),
            ),
            array(
                'class' => 'close',
                'icon_class' => 'close_items',
                'href' => route('admin.Banners.list'),
                'text' => __('admin.close'),
            ),
        ),
        'title' => \App\Models\ModulesConfiguration::getModuleName('bannersModule') ?? '',
    ])

    @include('admin.error')
    <form class="form-block product-form" action="{{isset($banner) ? route('admin.Banners.editBanner', ['bannerID' => $banner->id]) : route('admin.Banners.addBanner')}}" id="single-banner-form"
          method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="grid-row-12">
    {{--        left block--}}
            <div class="col-lg-9 col-md-9 col-12">
                <div class="white-block">
                    <div class="grid-row-12">
                        <div class="col-sm-4 col-12 image-parent-block">
                            <div class="form-group">
                                <img class="img-fluid" src="{{ $banner->banner_url ?? '/administrator/images/default-product.jpg' }}" alt="{{$banner->bannerI18N->description ?? 'Banner'}}">
                            </div>
                            @include('admin.image-block', [
                                'input_name' => 'image',
                                'value' => $banner->banner_url ?? '',
                                'folder' => 'banner',
                            ])
                        </div>
                {{--        center block--}}
                        <div class="col-sm-8 col-12">
                            <div class="panel-body product-desc">
                                <input type="hidden" name="id" {!!isset($banner) ? 'value="'.$banner->id.'"' : ''!!}>
                                <div class="grid-row-12">
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>@lang('banner.banner-type')</label>
                                            <select class="form-control one-item-dropdown-chosen check-banner-type" name="banner_type">
                                                <option value="" {{isset($banner) && $banner->banner_type > 0 ? '' : 'selected'}}>@lang('admin.notChoosing')</option>
                                                <option value="1" {{isset($banner) &&  $banner->banner_type == 1 ? 'selected' : ''}}>
                                                    @lang('banner.category-banner')
                                                </option>
                                                <option value="2" {{isset($banner) &&  $banner->banner_type == 2 ? 'selected' : ''}}>
                                                    @lang('banner.product-banner')
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group product-banner">
                                            <label>@lang('banner.banner-url')</label>
                                            <input class="form-control" type="text"
                                                   name="product_url" {!! isset($banner) ? 'value="'.$banner->url.'"' : '' !!}>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid-row-12">
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group category-banner">
                                            <label>@lang('banner.banner-discount')</label>
                                            <input class="form-control" type="text"
                                                   name="discount" {!! isset($banner) ? 'value="'.$banner->discount.'"' : '' !!}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group white-spaces category-banner">
                    <div class="checkbox check-block">
                        <input id="descr-check" type="checkbox" value="1">
                        <label for="descr-check">
                            <span class="checkbox-icon"></span>@lang('banner.add-category-descr')
                            <div class="products-arrow">
                                <span class="icon-material-outline-keyboard-arrow-down material-icon black"></span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="white-block other-data-block category-banner">
                    <div class="tabs">
                        <ul>
                            @foreach($allLanguages as $language)
                                <li>
                                    <a class="nav-link bold text-uppercase" id="lang_{{$language}}-tab" data-toggle="tab" href="#lang_{{$language}}" role="tab" aria-controls="lang_{{$language}}" aria-selected="false" style="text-transform: uppercase">{{$language}}</a>
                                </li>
                            @endforeach
                        </ul>
                        @foreach($allLanguages as $language)
                            <div class="tab-pane fade" id="lang_{{$language}}" role="tabpanel" aria-labelledby="lang_{{$language}}-tab">
                                <div class="grid-row-12">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="bold" for="description_{{$language ?? ''}}">@lang('banner.description') {{$language ?? ''}}:</label>
                                            <input class="form-control" type="text"
                                                   name="description_{{$language ?? ''}}" value="{{isset($banner, $banner->langBannersI18N($language)->description) ? $banner->langBannersI18N($language)->description : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

    {{--        right attach block--}}
            <div class="col-lg-3 col-md-3 col-12" style="position: relative">
                <div class="right-attach">
                    <div class="right-attach-block panel mb-15">
                        <div class="right-attach-title">@lang('admin.actions')</div>
                        <div class="right-attach-body panel-body">
                            <div class="form-group">
                                <div class="checkbox">
                                    <input type="checkbox" name="active" {{ isset($banner) && $banner->active == 1 ? 'checked' : ''}}>
                                    <label for="active">
                                        <span class="checkbox-icon"></span>@lang('banner.active')
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    @parent
    <script src="{{asset('/administrator/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('/administrator/js/tinymce/mce_initialization.js?v='.env('BUILD_VERSION'))}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('administrator/js/banner.js?v='.env('BUILD_VERSION'))}}"></script>
@endsection