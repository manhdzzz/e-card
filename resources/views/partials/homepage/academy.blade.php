{{-- ACADEMY / KNOWLEDGE from DB --}}
@php $articles = \App\Models\KnowledgeArticle::where('is_active', true)->orderBy('sort_order')->get(); @endphp
<div class="e-academy">
<div class="wrapper">
    <div class="image cover wave"><img src="{{ asset('assets/images/wave.png') }}" alt="Wave" /></div>
    <div class="uk-container uk-container-center">
        <div class="panel"><div class="wrapper">
            <div class="name"><strong>Kiến thức ECard</strong></div>
            <div class="description"><p>ECard là danh thiếp điện tử thông minh, giúp bạn chia sẻ thông tin cá nhân và công việc một cách nhanh chóng, chuyên nghiệp mà không cần in ấn.</p></div>
        </div></div>
        <div class="grid">
            <div class="uk-grid uk-grid-medium uk-grid-width-1-2 uk-grid-width-medium-1-4 uk-grid-match">
                @foreach($articles as $a)
                <div>
                    <div class="item">
                        <div class="image cover"><a href="{{ route('knowledge.show', $a->slug) }}"><img src="{{ $a->image ?: asset('assets/images/knowledge1.png') }}" alt="{{ $a->title }}"/></a></div>
                        <div class="body">
                            <div class="name name-2"><a href="{{ route('knowledge.show', $a->slug) }}"><strong>{{ $a->title }}</strong></a></div>
                            <div class="description"><p><span>{{ Str::limit($a->short_desc, 70) }}</span><a href="{{ route('knowledge.show', $a->slug) }}" class="more"><span>Xem thêm</span><i class="ti ti-arrow-right"></i></a></p></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
