<nav class="navbar navbar-expand-lg shadow mynavbg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand mytextcolor" href="{{ route('homepage') }}">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link active d-flex align-items-center text-nowrap mytextcolor" aria-current="page" href="{{ route('homepage') }}">
                        {{ __('ui.home') }} <i class="fa-solid fa-house-chimney ms-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-nowrap mytextcolor" href="{{ route('index.article') }}">
                        {{ __('ui.allArticles') }} <i class="fa-solid fa-newspaper ms-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-nowrap mytextcolor" href="{{ route('aboutUs') }}">
                        {{ __('ui.we') }} <i class="fa-solid fa-map-pin ms-1"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-nowrap mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('ui.categories') }} <i class="fa-solid fa-list ms-1"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item text-capitalize mynavbg mytextcolor d-flex align-items-center text-nowrap" 
                               href="{{ route('byCategory', ['category' => $category]) }}">
                               {{ __('ui.' . $category->name) }}
                            </a>
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
                        <a href="{{ route('index.revisor') }}" class="nav-link d-flex align-items-center text-nowrap mytextcolor">
                            {{ __('ui.revisorDashboard') }} <i class="fa-solid fa-briefcase ms-1"></i>
                        </a>
                        @if ($revisorCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $revisorCount }}
                        </span>
                        @endif
                    </li>
                    @endif

                    @if (Auth::user()->is_seller)
                    <li class="nav-item position-relative">
                        <a href="{{ route('index.seller') }}" class="nav-link d-flex align-items-center text-nowrap mytextcolor">
                            {{ __('ui.sellerDashboard') }} <i class="fa-solid fa-hand-pointer ms-1"></i>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-nowrap mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('ui.hello') }}, {{ Auth::user()->name }} <i class="fa-solid fa-robot ms-1"></i>
                        </a>
                        <ul class="dropdown-menu mynavbg">
                            @if (Auth::user()->is_seller)
                            <li>
                                <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="{{ route('create.article') }}">
                                    {{ __('ui.publishArticle') }} <i class="fa-solid fa-marker ms-1"></i>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="#" 
                                   onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">
                                    {{ __('ui.logout') }} <i class="fa-solid fa-right-from-bracket ms-1"></i>
                                </a>
                            </li>
                            <form action="{{ route('logout') }}" method="POST" class="d-none" id="form-logout">@csrf</form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-nowrap mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('ui.helloUser') }} <i class="fa-solid fa-user ms-1"></i>
                        </a>
                        <ul class="dropdown-menu mynavbg">
                            <li>
                                <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="{{ route('login') }}">
                                    {{ __('ui.login') }} <i class="fa-solid fa-door-open ms-1"></i>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="{{ route('register') }}">
                                    {{ __('ui.register') }} <i class="fa-solid fa-id-card ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>

            <form class="d-flex mx-2" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control me-2" type="search" name="query" placeholder="{{ __('ui.search') }}" aria-label="Search" />
                    <button class="btn btn-outline-secondary mytextcolor" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
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
