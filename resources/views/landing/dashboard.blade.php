<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Selamat datang di perpustakaan digital') }}
            </h2>
        </div>
    </x-slot>

    <div class="">
    <center>
        <div>
            <x-application-logo ></x-application-logo>
        </div>
    </center>

</x-app-layout>
