<x-shared.layout>
    <x-slot:title>{{__('ui.home')}}</x-slot:title>
    <div class="container text-center bg-body-tertiary margin-top-custom">
        <div class="row justify-content-center align-items-center mybg">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                <h1 class="display-1 mt-5">{{env('APP_NAME')}}</h1>
                <p class="fw-bold display-6 mt-5">{{ __('ui.subtitleHome') }}</p>
                <x-shared.flash-message />
                <x-shared.hero-section />
                <div class="mt-5">
                    @auth
                    @if (Auth::user()->is_seller)
                    <a href="{{route('create.article')}}" class="btn mybutton shadow">{{__('ui.publishArticle')}} <i class="fa-solid fa-marker"></i> </a>
                    @endif
                    @endauth
                </div>
            </div>
            <div class="col-12">
                <div class="row justify-content-center align-items-center py-5">
                    <h2 class="text-center color-custom pb-5">{{__('ui.ourArticle')}}</h2>
                    @forelse ($articles as $article)
                    <div class="col-12 col-md-3">
                        <x-article.article-card :article="$article" />
                    </div>
                    @empty
                    <div class="col-12">
                        <h3 class="text-center">
                            {{__('ui.noArticle')}}
                        </h3>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <x-shared.animation />
</x-shared.layout>