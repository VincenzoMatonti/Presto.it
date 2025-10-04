<x-shared.layout>
    <x-slot:title>{{__('ui.sellerDashboard')}}</x-slot:title>
    <x-shared.section-title title="{{__('ui.sellerDashboard')}}" subtitle="{{__('ui.sellerMessage')}}"/>
    <livewire:seller.dashboard-seller />
</x-shared.layout>