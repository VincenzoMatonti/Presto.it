<nav class="navbar navbar-expand-lg shadow mynavbg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand mytextcolor" href="{{route('homepage')}}">Presto.it</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active mytextcolor" aria-current="page" href="{{route('homepage')}}">Home <i class="fa-solid fa-house-chimney"></i> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mytextcolor" aria-current="page" href="{{route('index.article')}}">Tutti gli articoli <i class="fa-solid fa-newspaper"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorie <i class="fa-solid fa-list"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        @foreach ($categories as $category)
                           <li>
                               <a class="dropdown-item text-capitalize mynavbg mytextcolor" href="{{route('byCategory', [ 'category' => $category ])}}">{{$category->name}}</a>                            
                           </li>
                           @if (!$loop->last)
                             <hr class="dropdown-divider">
                           @endif
                        @endforeach
                    </ul>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ciao, {{ Auth::user()->name }} <i class="fa-solid fa-robot"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        <li>
                            <a class="dropdown-item mynavbg mytextcolor" href="{{route('create.article')}}">Crea articolo <i class="fa-solid fa-marker"></i> </a>
                        </li>
                        <hr class="dropdown-divider">
                        <li> <a href="#" class="dropdown-item mynavbg mytextcolor"
                                onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">Logout <i class="fa-solid fa-right-from-bracket mx-1"></i></a>
                        </li>
                        <form action="{{route('logout')}}" method="POST" class="d-none" id="form-logout">@csrf</form>
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ciao, utente! <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        <li><a class="dropdown-item mynavbg mytextcolor" href="{{route('login')}}">Accedi<i class="fa-solid fa-door-open mx-3"></i></a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item mynavbg mytextcolor" href="{{route('register')}}">Registrati<i class="fa-solid fa-id-card mx-3"></i></a></li>
                    </ul>
                </li>
                @endauth
            </ul>
            <form class="d-flex " role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-secondary mytextcolor" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</nav>