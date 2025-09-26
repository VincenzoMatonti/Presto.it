<nav class="navbar navbar-expand-lg shadow mynavbg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand mytextcolor" href="{{route('homepage')}}">{{env('APP_NAME')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active mytextcolor" aria-current="page" href="{{route('homepage')}}">{{__('ui.home')}} <i class="fa-solid fa-house-chimney"></i> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mytextcolor" aria-current="page" href="{{route('index.article')}}">{{__('ui.allArticles')}} <i class="fa-solid fa-newspaper"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__('ui.categories')}} <i class="fa-solid fa-list"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item text-capitalize mynavbg mytextcolor" href="{{route('byCategory', [ 'category' => $category ])}}">{{__('ui.' . $category->name)}}</a>
                        </li>
                        @if (!$loop->last)
                        <hr class="dropdown-divider">
                        @endif
                        @endforeach
                    </ul>
                </li>
                @auth
                @if (Auth::user()->is_revisor)
                <li class="nav-item position-relative">
                    <a href="{{ route('index.revisor') }}" class="nav-link mytextcolor ">{{ __('ui.revisorDashboard') }} <i class="fa-solid fa-briefcase"></i></a>
                    @if ($revisorCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{$revisorCount}}
                    </span>
                    @endif
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('ui.hello') }}, {{ Auth::user()->name }} <i class="fa-solid fa-robot"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        <li>
                            <a class="dropdown-item mynavbg mytextcolor" href="{{route('create.article')}}">{{ __('ui.publishArticle') }} <i class="fa-solid fa-marker"></i> </a>
                        </li>
                        <hr class="dropdown-divider">
                        <li> <a href="#" class="dropdown-item mynavbg mytextcolor"
                                onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">{{__('ui.logout')}} <i class="fa-solid fa-right-from-bracket mx-1"></i></a>
                        </li>
                        <form action="{{route('logout')}}" method="POST" class="d-none" id="form-logout">@csrf</form>
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__('ui.helloUser')}} <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        <li><a class="dropdown-item mynavbg mytextcolor" href="{{route('login')}}">{{__('ui.login')}}<i class="fa-solid fa-door-open mx-3"></i></a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item mynavbg mytextcolor" href="{{route('register')}}">{{__('ui.register')}}<i class="fa-solid fa-id-card mx-3"></i></a></li>
                    </ul>
                </li>
                @endauth
            </ul>
            <form class="d-flex mx-2" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control me-2" type="search" name="query" placeholder="{{ __('ui.search') }}" aria-label="Search" />
                    <button class="btn btn-outline-secondary mytextcolor" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <x-shared._locale lang="de" />
            <x-shared._locale lang="fr" />
            <x-shared._locale lang="es" />
            <x-shared._locale lang="it" />
            <x-shared._locale lang="en" />
        </div>
    </div>
</nav>