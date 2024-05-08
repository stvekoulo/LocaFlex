
@component('mail::message')

Bonjour {{$user->name}},

Nous tenons à vous informer qu'une nouvelle demande de réservation a été effectuée pour l'un de vos services sur la plateforme {{ config('app.name') }}.

@component('mail::button', ['url' => url(route(('demande.index')))])
Cliquez ici pour consulter la demande
@endcomponent

Veuillez ne pas répondre à cet e-mail.

Merci,

L'équipe {{ config('app.name') }}

<a class="site_link" href="{{route('home')}}">
    <img src="{{asset('Template/assets/images/logo/site_logo.svg')}}" alt="Collab - Plateforme de réservation en ligne">
</a>
@endcomponent
