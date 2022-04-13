<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <h1 class='text-4xl mb-5'>Upcoming Appointments</h1>
        <p>You have no upcoming appointments</p>
    </x-slot>
</x-app-layout>