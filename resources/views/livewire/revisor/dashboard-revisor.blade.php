<div class="container mybgsec shadow rounded-3">

    <x-shared.flash-message />

    @if($articleToCheck)
    <div class="row justify-content-center pt-5">
        <div class="col-12">
            <div class="row justify-content-center">
                @if($articleToCheck->images->count())
                @foreach($articleToCheck->images as $key => $image)
                <div class="col-12 col-md-6 mb-4">
                    <div class="card mb-3">
                        <div class="row g-0 mybg rounded-3 shadow">
                            <div class="col-4 col-md-4 d-flex justify-content-center align-items-center p-2">
                                <img src="{{ $image->getUrl(300, 300) }}" class="img-fluid rounded shadow"
                                alt="Immagine {{$key + 1}} dell'articolo '{{$articleToCheck->title}}">
                            </div>
                            <div class="col-3 col-md-3 ps-3">
                               <div class="card-body">
                                <h6 class="text-center fst-italic ">{{__('ui.labels')}}</h6>
                                @if ($image->labels)
                                   @foreach ($image->labels as $label)
                                       #{{ $label }}, 
                                   @endforeach
                                @else
                                   <p class="fst-italic"> {{ __('ui.noLabels') }} </p>
                                @endif
                               </div>
                            </div>
                            <div class="col-5 col-md-5 ps-3">
                                <div class="card-body d-flex justify-content-center align-items-center p-4 flex-column">
                                    <h6 class="text-center fst-italic ">{{__('ui.ratings')}}</h6>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="text-center">
                                                <i class="mx-auto {{ $image->adult }} fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <p class="text-center text-muted small">{{__('ui.adult')}}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="text-center">
                                                <i class=" mx-auto {{ $image->violence }} fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <p class="text-center text-muted small">{{__('ui.violence')}}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="text-center">
                                                <i class=" mx-auto {{ $image->spoof }} fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <p class="text-center text-muted small text-nowrap">{{__('ui.spoof')}}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="text-center">
                                                <i class=" mx-auto {{ $image->racy }} fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <p class="text-center text-muted small">{{__('ui.racy')}}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="text-center">
                                                <i class=" mx-auto {{ $image->medical }} fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <p class="text-center text-muted small">{{__('ui.medical')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <div class="col-12 ps-4 d-flex flex-column justify-content-between">
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