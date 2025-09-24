<x-shared.layout>
    <x-slot:title>All articles</x-slot:title>
    <x-shared.section-title title="Tutti gli articoli" subtitle="Scopri tutte le occasioni disponibili: trova subito ciò che ti serve." />
    <div class="container-fluid mybg">
        <div class="row justify-content-center align-items-center py-5">
            @forelse ($articles as $article)
              <div class="col-12 col-md-3">
                <x-article.article-card :article="$article" />
              </div>
            @empty
              <div class="col-12">
                 <h3 class="text-center">
                    Non sono ancora stati creati articoli
                 </h3>
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