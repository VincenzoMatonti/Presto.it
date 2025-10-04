<x-shared.layout>
  <x-slot:title>{{__('ui.allArticles')}}</x-slot:title>
  <x-shared.section-title title="{{__('ui.allArticles')}}" subtitle="{{__('ui.subIndexArticle')}}" />
  <div class="container-fluid mybg">
    <div class="row justify-content-center align-items-center py-5">
      @forelse ($articles as $article)
      <div class="col-12 col-md-3">
        <x-article.article-card :article="$article" />
      </div>
      @empty
      <div class="col-12 d-flex flex-column justify-content-center align-items-center">
        <h3 class="text-center">
          {{__('ui.noArticle')}}
        </h3>
        @auth
        @if (Auth::user()->is_seller)
        <div class="mt-5">
          <a href="{{route('create.article')}}" class="btn mybutton shadow">{{__('puublishArticle')}} <i class="fa-solid fa-marker"></i> </a>
        </div>
        @endif
        @endauth
      </div>
      @endforelse
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <div>
      {{ $articles->links() }}
    </div>
  </div>
</x-shared.layout>