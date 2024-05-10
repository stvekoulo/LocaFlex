
@component('mail::message')

Cher {{$user->name}},

Nous tenons à vous informer que votre compte a été crédité suite a un payement effectuée pour l'un de vos services ou biens.

@component('mail::button', ['url' => url(route(('dashboard')))])
Cliquez ici pour consulter
@endcomponent

Veuillez ne pas répondre à cet e-mail.

Merci,

L'équipe {{ config('app.name') }}

<a class="site_link" href="{{route('home')}}">
    <img src="{{asset('Template/assets/images/logo/site_logo.svg')}}" alt="Collab - Plateforme de réservation en ligne">
</a>
@endcomponent
