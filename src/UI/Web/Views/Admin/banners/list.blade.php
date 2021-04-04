@extends('admin.layout')

@section('content')
    <form class="btn btn-info" action="{{ route('admin.Banners.removeByID')}}" method="GET" id="remove_items"
          onsubmit="removeSelectItemsAjax(this, event,'bannersModule')"></form>

    @php
        $header_data = array(
            'title' =>\App\Models\ModulesConfiguration::getModuleName('bannersModule') ?? '',
            'buttons_group' => array(
                 array(
                    'class' => 'blue',
                    'icon_class' => 'add_items',
                    'href' => route('admin.Banners.addBanner'),
                    'text' => __('admin.addNew'),
                 ),
            ),
        );
        if(Auth::user()->role == 'su') {
            $button = array(
                'class' => 'remove',
                'icon_class' => 'remove_items',
                'form' => 'remove_items',
                'text' => __('admin.remove'),
            );
            array_push($header_data['buttons_group'], $button);
        }
    @endphp
    @include('admin.buttons-group', $header_data)

    @include('admin.error')

    @if(isset($banners) && $banners->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    @if(Auth::user()->role == 'su')
                        <th>
                            <div class="checkbox check-block">
                                <input id="all-check-product" class="all-select-checkbox-items" type="checkbox" onchange="allSelectCheckboxItems(this)">
                                <label style="justify-content: center;" for="all-check-product">
                                    <span class="checkbox-icon"></span>
                                </label>
                            </div>
                        </th>
                    @endif
                    <th>@lang('ads::banner.active')</th>
                    <th>id</th>
                    <th>@lang('ads::banner.photo')</th>
                    <th>@lang('ads::banner.description')</th>
                    <th>@lang('ads::banner.banner-type')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        @if(Auth::user()->role == 'su')
                            <td>
                                <div class="checkbox check-block">
                                    <input id="{{$banner->id}}-check" name="item_id[]" class="select-checkbox-items" type="checkbox" value="{{$banner->id}}" form="remove_items">
                                    <label for="{{$banner->id}}-check" style="justify-content: center;">
                                        <span class="checkbox-icon"></span>
                                    </label>
                                </div>
                            </td>
                        @endif
                        <td>
                            <input hidden name="product_id" value="{{$banner->id}}">
                            <span class="btn check-item" data-item-id="{{$banner->id}}" onclick="changeThisItemStatusAjax(this)" data-active="{{ $banner->active ?? 0 }}">
                                <span class="circle {{($banner->active == 1) ? 'icon-line-awesome-check' : 'icon-line-awesome-close'}}"></span>
                            </span>
                        </td>
                        <td><a href="{{ route('admin.Banners.editBanner', ['bannerID' => $banner->id]) }}">{{$banner->id}}</a></td>
                        <td>
                            <a href="{{ route('admin.Banners.editBanner', ['bannerID' => $banner->id]) }}">
                                <img width="60px" src="{{isset($banner->banner_url) ? $banner->banner_url  : asset('/administrator/images/default-product.jpg') }}" alt="{{$banner->langBannersI18N(LocaleMiddleware::$mainLanguage)->name ?? 'product-image'}}">
                            </a>
                        </td>
                        <td><a href="{{ route('admin.Banners.editBanner', ['bannerID' => $banner->id]) }}">{{$banner->langBannersI18N(LocaleMiddleware::$mainLanguage)->description ?? '-'}}</a></td>
                        <td>{{isset($banner->banner_type) ? ($banner->banner_type == \App\Modules\BannersModule\Models\Banners::PRODUCT_BANNER_TYPE ? 'Product Banner' : 'Category Banner')  : '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form method="get" action="{{ route('admin.Banners.changeStatusByIdAjax') }}" id="change-status">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="admin-pagination">
            {{$banners->appends(\Illuminate\Support\Facades\Input::except('page'))->links()}}
        </div>
    @else
        <div class="alert alert-success">
            @lang('admin.nothingCreated')
        </div>
    @endif
@endsection