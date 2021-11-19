@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm bg-gray-100 border-gray-300 focus:border-indigo-300 focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50']) !!}>
