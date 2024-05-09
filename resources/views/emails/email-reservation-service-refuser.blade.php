@component('mail::message')

Cher {{$user->name}},

Nous vous informons avec regret qu'une de vos demandes de service a été rejetée. Nous vous encourageons à parcourir notre catalogue pour trouver un service équivalent ou à soumettre une nouvelle demande.

@component('mail::button', ['url' => url(route(('home')))])
Cliquez ici pour accéder directement au site web
@endcomponent

Veuillez ne pas répondre à cet e-mail.

Cordialement,

L'équipe de {{ config('app.name') }}

<a class="site_link" href="{{route('home')}}">
    <img src="{{asset('Template/assets/images/logo/site_logo.svg')}}" alt="Collab - Plateforme de location en ligne">
</a>

@endcomponent
