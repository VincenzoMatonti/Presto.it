<x-shared.layout>
    <x-slot:title>{{__('ui.articleDetail')}}</x-slot:title>
    <x-shared.section-title title="{{__('featuredItem')}} {{$article->title}}" subtitle="{{__( 'ui.detailPriceCategory')}}" />
    <div class="container mybgsec shadow p-5 rounded-3">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 mb-3">
                @if ($article->images->count() > 0)
                <div id="carouselExampleFade" class="carousel slide carousel-fade shadow">
                    <div class="carousel-inner shadow border-3 rounded-2">
                        @foreach ($article->images as $key => $image)
                          <div class="carousel-item @if($loop->first) active @endif">
                             <img src="{{ Storage::url($image->path) }}"  class="d-block w-100 rounded shadow" 
                                  alt="Immagine {{ $key + 1 }} dell'articolo {{$article->title}} ">
                          </div>
                        @endforeach
                    </div>
                    @if ($article->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
                @else
                  <img src="https://picsum.photos/300" alt="Nessuna foto inserita dall'utente" class="d-block w-100 rounded shadow">
                @endif
            </div>
            <div class="col-12 col-md-6 mb-3 text-center">
                <h2 class="display-5"> <span class="fw-bold">{{__('ui.title')}}: </span> {{$article->title}} </h2>
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">{{__('ui.price')}}: {{$article->price}} €</h4>
                    <h5>{{__('ui.description')}}</h5>
                    <p>{{$article->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mybg d-flex justify-content-center align-items-center p-3">
        <a href="{{route('index.article')}}" class="color-custom btn">{{__('ui.allArticles')}} <i class="fa-solid fa-xmark"></i></a>
    </div>
</x-shared.layout>