<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
        <img src=<?php echo $message->embed(asset("images/logo_health_pets.png")) ?> class="logo" alt="Logo Healthpets">
        <p>Aqui esta a aimagem asset("images/logo_health_pets.png")</p>
@endif
</a>
</td>
</tr>


