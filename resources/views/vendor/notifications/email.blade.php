@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# Olá!
@endif
@endif

{{-- Intro Lines --}}
Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Resetar Senha
@endcomponent
@endisset

{{-- Outro Lines --}}
Se você não solicitou uma reinicialização da senha, nenhuma ação adicional será necessária.

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Saudações,<br>Realiza Rent a Car
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Se você estiver tendo problemas para clicar no botão "{{ $actionText }}",
copie e cole o URL abaixo em seu navegador da Web:[{{ $actionUrl }}]({{ $actionUrl }})

@endcomponent
@endisset
@endcomponent
