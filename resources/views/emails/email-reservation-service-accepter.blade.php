@component('mail::message')

Cher {{$user->name}},

Nous avons le plaisir de vous informer qu'une de vos demande de service à été accepter

@component('mail::button', ['url' => url(route(('payment.index')))])
Cliquez ici pour procéder au paiment
@endcomponent

Veuillez ne pas répondre à cet e-mail.

Cordialement,

L'équipe de {{ config('app.name') }}

<a class="site_link" href="{{route('home')}}">
    <img src="{{asset('Template/assets/images/logo/site_logo.svg')}}" alt="Collab - Plateforme de location en ligne">
</a>

@endcomponent
