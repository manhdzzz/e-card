<!DOCTYPE html>
<html lang="vi">
<head>
    <title>{{ $article->title }} - Kiến thức ECard</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @php
        $logo = \App\Models\SiteSetting::get('site_logo');
        $faviconUrl = $logo ? (\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/favicon.png');
    @endphp
    <link href="{{ $faviconUrl }}" rel="icon" type="image/png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-ecard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ecard-original.css') }}" rel="stylesheet" />
    <style>
        .article-content h2 { margin-top: 30px; font-weight: bold; color: #333; border-left: 5px solid #052542; padding-left: 15px; }
        .article-content p { line-height: 1.6; margin-bottom: 15px; text-align: justify; }
        .article-content ul, .article-content ol { margin-bottom: 20px; }
        .article-content li { margin-bottom: 8px; line-height: 1.5; }
        .article-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 20px 0; }
        .article-content table { width: 100%; border-collapse: collapse; margin: 25px 0; }
        .article-content th, .article-content td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .article-content th { background-color: #f8f9fa; font-weight: bold; }
        .article-content tr:nth-child(even) { background-color: #fdfdfd; }
    </style>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=833157024011668&autoLogAppEvents=1"></script>
    
    @include('partials.header')

    <div class="e-article-header" style="background: #f5f5f5; padding: 20px 0;">
        <div class="uk-container uk-container-center">
            <ul class="uk-breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li><a href="#">Kiến thức</a></li>
                <li class="uk-active"><span>{{ $article->title }}</span></li>
            </ul>
        </div>
    </div>

    <div class="e-page" style="padding: 40px 0;">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-medium-3-4">
                    <div class="e-article-item">
                        <div class="wrapper">
                            <div class="panel">
                                <div class="name"><h1>{{ $article->title }}</h1></div>
                                <div class="description" style="font-size: 1.1em; color: #666; margin-bottom: 20px; font-style: italic;">
                                    {{ $article->short_desc }}
                                </div>
                                @if($article->image)
                                <div class="image" style="margin-bottom: 30px;">
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}" style="width: 100%; border-radius: 8px;">
                                </div>
                                @endif
                                <div class="content article-content">
                                    {!! $article->full_desc !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-4">
                    <div class="sidebar">
                        <div class="panel" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                            <h3>Bài viết khác</h3>
                            @php $otherArticles = \App\Models\KnowledgeArticle::where('id', '!=', $article->id)->get(); @endphp
                            <ul class="uk-list uk-list-line">
                                @foreach($otherArticles as $oa)
                                <li><a href="{{ route('knowledge.show', $oa->slug) }}">{{ $oa->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="e-fanpage" style="margin-top: 25px;">
                            <div class="wrapper">
                                <div class="fb-page" 
                                    data-href="{{ \App\Models\SiteSetting::get('facebook_page_url', 'https://www.facebook.com/ecard.vn') }}" 
                                    data-tabs="events" 
                                    data-width="500" 
                                    data-height="135" 
                                    data-small-header="false" 
                                    data-adapt-container-width="true" 
                                    data-hide-cover="false" 
                                    data-show-facepile="true">
                                    <blockquote cite="{{ \App\Models\SiteSetting::get('facebook_page_url', 'https://www.facebook.com/ecard.vn') }}" class="fb-xfbml-parse-ignore">
                                        <a href="{{ \App\Models\SiteSetting::get('facebook_page_url', 'https://www.facebook.com/ecard.vn') }}">Facebook Page</a>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.homepage.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
</body>
</html>
