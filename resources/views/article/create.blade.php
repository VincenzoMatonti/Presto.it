<x-shared.layout>
    <x-slot:title>{{__('ui.publishArticle')}}</x-slot:title>
    <x-shared.section-title title="{{__('ui.publishArticle')}}" subtitle="{{__('ui.firstStepProfit')}}" />
    <div class="container-fluid mybg">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 height-custom m-0">
                <livewire:article.create-article-form />
            </div>
        </div>
    </div>
</x-shared.layout>