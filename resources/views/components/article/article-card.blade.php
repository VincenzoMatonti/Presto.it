<div class="card mx-auto shadow border-2 text-center mb-3 card-custom mybgsec">
    <img src="{{$article->images->isNotEmpty() ? $article->images->first()->getUrl(300,300) : 'https://picsum.photos/200' }}" 
         class="shadow img-fluid rounded-top-2" alt="Immagine dell'articolo {{$article->title}}">
    <div class="card-body mybgsec">
        <h5 class="card-title">{{$article->title}}</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">{{$article->price}}</h6>
        <div class="d-flex justify-content-evenly align items center mt-5">
            <a href="{{ route('detail.article', compact('article')) }}" class="btn mybutton">{{__('ui.detail')}} <i class="fa-solid fa-circle-info"></i></a>
            <a href="{{route('byCategory', [ 'category' => $article->category ])}}" class="btn mybutton">{{__('ui.category')}} <i class="fa-solid fa-list"></i></a>
        </div>
    </div>
</div>