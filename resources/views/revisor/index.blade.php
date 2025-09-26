<x-shared.layout>
    <x-slot:title>{{__('ui.revisorDashboard')}}</x-slot:title>
    <x-shared.section-title title="{{__('ui.revisorDashboard')}}" subtitle="{{__('ui.moderationMessage')}}"/>
    <livewire:revisor.dashboard-revisor />
</x-shared.layout>