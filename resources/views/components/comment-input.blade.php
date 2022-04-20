@props(['disabled' => false])
<div class='flex'>
    <div class='ml-10 border border-grey-300'></div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "p-3 mt-4 ml-5 rounded-md shadow-sm border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-[90%]"]) !!}>
</div>