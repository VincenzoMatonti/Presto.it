<div class="container mybgsec shadow rounded-3">

    <x-shared.flash-message />

    @if($articleToCheck)
    <div class="row justify-content-center pt-5">
        <div class="col-12 col-md-8">
            <div class="row justify-content-center">
                @if($articleToCheck->images->count())
                @foreach($articleToCheck->images as $key => $image)
                <div class="col-6 col-md-4 mb-4">
                    <img src="{{ $image->getUrl(300, 300) }}" class="img-fluid rounded shadow"
                        alt="Immagine {{$key + 1}} dell'articolo '{{$articleToCheck->title}}">
                </div>
                @endforeach
                @else
                @for($i = 0; $i < 6; $i++)
                    <div class="col-6 col-md-4 mb-4 text-center">
                    <img src="https://picsum.photos/300" class="img-fluid rounded shadow" alt="Immagine segnaposto">
                 </div>
                @endfor
                @endif
             </div>
        </div>
    <div class="col-12 col-md-4 ps-4 d-flex flex-column justify-content-between">
        <div>
            <h1>{{$articleToCheck->title}}</h1>
            <p class="h3">{{__('ui.author')}} {{$articleToCheck->user->name}}</p>
            <p class="h4">{{$articleToCheck->price}}€</p>
            <p class="fst-italic text-muted">#{{__('ui.' . $articleToCheck->category->name)}}</p>
            <p class="h6">{{$articleToCheck->description}}</p>
        </div>
        <div class="d-flex pb-4 justify-content-around">
            <button wire:click="accept({{$articleToCheck}})" class="btn btn-outline-success">
                {{__('ui.accept')}} <i class="fa-solid fa-check"></i>
            </button>
            <button wire:click="reject({{$articleToCheck}})" class="btn btn-outline-danger">
                {{__('ui.reject')}} <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>
@else
<div class="row justify-content-center align-items-center text-center">
    <div class="col-12">
        <h1 class="fst-italic display-4 p-3">
            {{__('ui.noArticlesToReview')}}
        </h1>
        <a href="{{route('homepage')}}" class="my-5 btn btn-success">{{__('ui.backToHome')}} <i class="fa-solid fa-house"></i></a>
    </div>
</div>
@endif

</div>