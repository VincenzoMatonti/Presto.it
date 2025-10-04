<div class="container mybgsec rounded-3 border-3 shadow">
    <div class="row justify-content-center">
        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center my-3 flex-column">
            <p class="text-muted fst-italic ">{{__('ui.accepted')}}: <span class="fs-bold text-danger">{{ $articleCheckNumber->count() }}</span></p>
            <button wire:click="showAcceptArticleTable" class="btn border-3 rounded-3 shadow {{$btnClassesAccept}}">
                {{$btnTextAccept}} <i class="fa-solid fa-hourglass-start"></i>
            </button>
        </div>
        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center my-3 flex-column">
            <p class="text-muted fst-italic ">{{__('ui.rejected')}}: <span class="fs-bold text-danger">{{ $articleRejectNumber->count() }}</span></p>
            <button wire:click="showRejectArticleTable" class="btn border-3 rounded-3 shadow {{$btnClassesReject}}">
                {{$btnTextReject}} <i class="fa-solid fa-hourglass-start"></i>
            </button>
        </div>
        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center my-3 flex-column">
            <p class="text-muted fst-italic small">{{__('ui.revisioned')}}: <span class="fs-bold text-danger">{{ $articleToCheck->count() }}</span></p>
            <button wire:click="showReviewArticleTable" class="btn border-3 rounded-3 shadow {{$btnClassesReview}}">
                {{$btnTextReview}} <i class="fa-solid fa-hourglass-start"></i>
            </button>
        </div>
    </div>
    <div class="row justify-content-center my-3">
        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center my-3 flex-column">
            <button wire:click="showCreateArticleForm" class="btn border-3 rounded-3 shadow {{$btnClassesCreate}}">
                {{$btnTextCreate}} <i class="fa-solid fa-marker"></i> 
            </button>
        </div>
    </div>
    <div class="row">
        <div class="container  p-3">
            <div class="row justify-content-evenly">
                @if ($showFormAccept)
                <div class="col-12 col-md-3 mybg shadow rounded-3 border-3">
                    <p class="fw-bold fs-5">{{__('ui.accepted')}}:</p>
                    @if(count($articleCheck) > 0)
                    <table class="table table-striped  border-3 shadow p-3">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">{{__('ui.title')}}</th>
                                <th scope="col">{{__('ui.price')}}</th>
                                <th scope="col">{{__('ui.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articleCheck as $article)
                            <tr>
                                <th scope="row">{{ $article->id }}</th>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->price }}</td>
                                <td>
                                    <button wire:click="" class="btn btn-danger btn-sm rounded-5 shadow border">{{__('ui.revision')}}<i class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <div>
                            {{ $articleCheck->links() }}
                        </div>
                    </div>
                    @else
                    <p class="text-danger py-1 text-center fw-bold fs-5">{{__('ui.noAccept')}}</p>
                    @endif
                </div>
                @endif
                @if ($showFormReject)
                <div class="col-12 col-md-3 mybg shadow rounded-3 border-3">
                    <p class="fw-bold fs-5">{{__('ui.rejected')}}:</p>
                    @if(count($articleReject) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">{{__('ui.title')}}</th>
                                <th scope="col">{{__('ui.price')}}</th>
                                <th scope="col">{{__('ui.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articleReject as $art)
                            <tr>
                                <th scope="row">{{ $art->id }}</th>
                                <td>{{ $art->title }}</td>
                                <td>{{ $art->price }}</td>
                                <td>
                                    <button wire:click="" class="btn btn-danger btn-sm rounded-5 shadow border">{{__('ui.revision')}}<i class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <div>
                            {{ $articleReject->links() }}
                        </div>
                    </div>
                    @else
                    <p class="text-danger py-1 text-center fw-bold fs-5">{{__('ui.noReject')}}</p>
                    @endif
                </div>
                @endif
                @if ($showFormReview)
                <div class="col-12 col-md-3 mybg shadow rounded-3 border-3">
                    <p class="fw-bold fs-5">{{__('ui.revisioned')}}:</p>
                    @if(count($articleReview) > 0)
                    <table class="table table-striped  border-3 shadow p-3">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">{{__('ui.title')}}</th>
                                <th scope="col">{{__('ui.price')}}</th>
                                <th scope="col">{{__('ui.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articleReview as $a)
                            <tr>
                                <th scope="row">{{ $a->id }}</th>
                                <td>{{ $a->title }}</td>
                                <td>{{ $a->price }}</td>
                                <td>
                                    <button wire:click="" class="btn btn-danger btn-sm rounded-5 shadow border">{{__('ui.revision')}}<i class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <div>
                            {{ $articleReview->links() }}
                        </div>
                    </div>
                    @else
                    <p class="text-danger py-1 text-center fw-bold fs-5">{{__('ui.noReview')}}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row p-5">
        @if ($showFormCreate)
         <livewire:article.create-article-form />
        @endif
    </div>
</div>