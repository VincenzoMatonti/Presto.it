<x-shared.layout>
    <x-slot:title>Home</x-slot:title>
    <div class="container-fluid text-center bg-body-tertiary">
        <div class="row vh-100 justify-content-center align-items-center mybg">
            <div class="col-12">
                <h1 class="display-1">Presto.it</h1>
                <p class="fw-bold display-6">"Trova, compra, vendi: ogni giorno nuove occasioni a portata di click!"</p>
                <div class="my-3 mt-5">
                    @auth
                     <a href="{{route('create.article')}}" class="btn mybutton">Pubblica un articolo <i class="fa-solid fa-marker"></i> </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-shared.layout>