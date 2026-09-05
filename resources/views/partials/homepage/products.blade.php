{{-- PRODUCTS from DB --}}
@php $products = \App\Models\Product::where('is_active', true)->orderBy('sort_order')->get(); @endphp
<div class="panel"><div class="wrapper"><div class="name"><h2>Giải pháp của ECard điện tử</h2></div></div></div>
<div class="grid product">
    <div class="uk-grid uk-grid-medium uk-grid-match">
        @foreach($products as $i => $p)
        <div class="uk-width-1-2 uk-width-medium-1-3{{ $i >= 2 ? ' mt15-small' : '' }}">
            <div class="item">
                <div class="image cover"><a href="{{ route('products.show', $p->slug) }}"><img src="{{ $p->image ?: asset('assets/images/product1.png') }}" alt="{{ $p->title }}"/></a></div>
                <div class="body">
                    <div class="name"><a href="{{ route('products.show', $p->slug) }}"><strong>{{ $p->title }}</strong></a></div>
                    <div class="meta"><span class="price">{{ $p->price }}</span></div>
                    <div class="description"><p><span>{{ Str::limit($p->short_desc, 80) }}</span><a href="{{ route('products.show', $p->slug) }}" class="more"><span>Xem thêm</span><i class="ti ti-arrow-right"></i></a></p></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
