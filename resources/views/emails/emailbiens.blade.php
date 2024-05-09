@component('mail::message')

Cher {{$user->name}},

Nous avons le plaisir de vous informer qu'une nouvelle demande de réservation pour l'un de vos biens a été effectuée.

@component('mail::button', ['url' => url(route(('demande.index')))])
Cliquez ici pour consulter la demande
@endcomponent

Veuillez ne pas répondre à cet e-mail.

Cordialement,

L'équipe de {{ config('app.name') }}

<a class="site_link" href="{{route('home')}}">
    <img src="{{asset('Template/assets/images/logo/site_logo.svg')}}" alt="Collab - Plateforme de réservation en ligne">
</a>

@endcomponent
