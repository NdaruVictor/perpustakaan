@props([
    'disabled' => false,
    'withicon' => false,
])

@php
    $withiconClasses = $withicon ? 'pl-11 pr-4' : 'px-4';
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        $withiconClasses .
        'relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-neutral-700 outline-none transition duration-300 ease-in-out focus:border-primary focus:bg-white focus:text-neutral-700 focus:shadow-[0_0_0_1px] focus:shadow-primary focus:outline-none dark:bg-transparent dark:text-gray-500 dark:focus:bg-transparent disabled:text-black',
]) !!}>
    {{ $slot }}
</select>
