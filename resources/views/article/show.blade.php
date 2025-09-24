<x-shared.layout>
    <x-slot:title>Detail article</x-slot:title>
    <x-shared.section-title title="Oggetto in primo piano: {{$article->title}}" subtitle="Dettagli, prezzo e categoria: trova subito le informazioni che ti servono." />
    <div class="container mybgsec shadow p-5 rounded-3">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 mb-3">
                <div id="carouselExampleFade" class="carousel slide carousel-fade shadow">
                    <div class="carousel-inner shadow border-3 rounded-2">
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/400" class="d-block w-100 img-fluid" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/401" class="d-block w-100 img-fluid" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/402" class="d-block w-100 img-fluid" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3 text-center">
                <h2 class="display-5"> <span class="fw-bold">Titolo: </span> {{$article->title}} </h2>
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="fw-bold">Prezzo: {{$article->price}} €</h4>
                    <h5>Descrizione</h5>
                    <p>{{$article->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mybg d-flex justify-content-center align-items-center p-3">
        <a href="{{route('index.article')}}" class="color-custom btn">Tutti gli articoli <i class="fa-solid fa-xmark"></i></a>
    </div>
</x-shared.layout>