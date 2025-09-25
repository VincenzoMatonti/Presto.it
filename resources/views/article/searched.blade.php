<x-shared.layout>
    <x-slot:title>Articles by search</x-slot:title>
    <x-shared.section-title title="Risultati per: «{{ $query }}»" subtitle="Tutti gli articoli per la parola selezionata, a portata di click." />
    <div class="container-fluid mybg">
        <div class="row justify-content-center align-items-center py-5">
            @forelse ($articles as $article)
            <div class="col-12 col-md-3">
                <x-article.article-card :article="$article" />
            </div>
            @empty
            <div class="col-12 d-flex flex-column align-items-center justify-content-center p-5">
                <h3 class="text-center my-3">
                    "Nessun articolo trovato per «{{ $query }}». Prova con un'altra parola chiave."
                </h3>
                @auth
                <div class="mt-5">
                    <a href="{{route('create.article')}}" class="btn mybutton shadow">Pubblica un articolo <i class="fa-solid fa-marker"></i> </a>
                </div>
                @endauth
            </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $articles->links() }}
        </div>
    </div>
</x-shared.layout>