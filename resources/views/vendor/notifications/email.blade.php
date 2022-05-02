{{--@component('mail::message')--}}
{{-- Greeting --}}
{{--@if (! empty($greeting))--}}
{{--# {{ $greeting }}--}}
{{--@else--}}
{{--@if ($level === 'error')--}}
{{--# @lang('Whoops!')--}}
{{--@else--}}
{{--# @lang('Hello!')--}}
{{--@endif--}}
{{--@endif--}}

{{-- Intro Lines --}}
{{--@foreach ($introLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Action Button --}}
{{--@isset($actionText)--}}
{{--<?php--}}
{{--    switch ($level) {--}}
{{--        case 'success':--}}
{{--        case 'error':--}}
{{--            $color = $level;--}}
{{--            break;--}}
{{--        default:--}}
{{--            $color = 'primary';--}}
{{--    }--}}
{{--?>--}}
{{--@component('mail::button', ['url' => $actionUrl, 'color' => $color])--}}
{{--{{ $actionText }}--}}
{{--@endcomponent--}}
{{--@endisset--}}

{{-- Outro Lines --}}
{{--@foreach ($outroLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Salutation --}}
{{--@if (! empty($salutation))--}}
{{--{{ $salutation }}--}}
{{--@else--}}
{{--@lang('Regards'),<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endif--}}

{{-- Subcopy --}}
{{--@isset($actionText)--}}
{{--@slot('subcopy')--}}
{{--@lang(--}}
{{--    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".--}}
{{--    'into your web browser:',--}}
{{--    [--}}
{{--        'actionText' => $actionText,--}}
{{--    ]--}}
{{--) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>--}}
{{--@endslot--}}
{{--@endisset--}}
{{-- @component('mail::message')
<h1>Hora de vacinar seu Pet</h1>
<p>Olá {{ $user->name }}, está chegando a hora de levar seu pet para tomar a vacina.</p>
<p>O(a) {{ $animal->nome }}, precisa tomar a vacina de {{ $vacina->nome }}, no dia {{ Carbon\Carbon::parse($vacina->data_aplicacao)->format('d/m/Y') }}.</p>
<p>Verifique sua agenda:</p>
@component('mail::button', ['url'=>'https://www.healthpets.app.br/agenda'])
    Minha Agenda
@endcomponent
@endcomponent --}}


@component('mail::message')
    <h1>Hora de vacinar seu Pet</h1>
    <p>Olá , está chegando a hora de levar seu pet para tomar a vacina.</p>
    <p>O(a) , precisa tomar a vacina de , no dia </p>
    <p>Verifique sua agenda:</p>
    @component('mail::button', ['url'=>'https://www.healthpets.app.br/agenda'])
        Minha Agenda
    @endcomponent
@endcomponent
{{--@endcomponent--}}
