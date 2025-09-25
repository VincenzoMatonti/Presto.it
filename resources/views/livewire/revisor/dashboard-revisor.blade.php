<div class="container mybgsec shadow rounded-3">

    <x-shared.flash-message />

    @if($articleToCheck)
    <div class="row justify-content-center pt-5">
        <div class="col-12 col-md-8">
            <div class="row justify-content-center">
                @for($i = 0; $i < 6; $i++)
                    <div class="col-6 col-md-4 mb-4 text-center">
                    <img src="https://picsum.photos/300" class="img-fluid rounded shadow" alt="Immagine segnaposto">
                    </div>
                @endfor
            </div>
        </div>
        <div class="col-12 col-md-4 ps-4 d-flex flex-column justify-content-between">
          <div>
            <h1>{{$articleToCheck->title}}</h1>
            <p class="h3">Autore: {{$articleToCheck->user->name}}</p>
            <p class="h4">{{$articleToCheck->price}}€</p>
            <p class="fst-italic text-muted">#{{$articleToCheck->category->name}}</p>
            <p class="h6">{{$articleToCheck->description}}</p>
          </div>
          <div class="d-flex pb-4 justify-content-around">
             <button wire:click="accept({{$articleToCheck}})" class="btn btn-outline-success">
                 Accetta <i class="fa-solid fa-check"></i>
             </button>
             <button wire:click="reject({{$articleToCheck}})" class="btn btn-outline-danger">
                 Rifiuta <i class="fa-solid fa-xmark"></i>
             </button>
          </div>
        </div>
    </div>
    @else
    <div class="row justify-content-center align-items-center text-center">
        <div class="col-12">
            <h1 class="fst-italic display-4">
                Nessun articolo da revisionare
            </h1>
            <a href="{{route('homepage')}}" class="my-5 btn btn-success">Torna all'homepage <i class="fa-solid fa-house"></i></a>
        </div>
    </div>
    @endif

</div>