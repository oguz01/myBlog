@component('mail::message')
    # Bizen Ulaşın formu

    İsim : {{ $first_name }}
    Soyİsim : {{ $last_name }}
    E-Mail : {{ $email }}
    Konu : {{ $subject }}
    Mesaj : {{ $message }}


    @component('mail::button', ['url' => 'https://www.3adimdais.com'])
        Siteyi Görüntüle
    @endcomponent

    Saygılarımla,<br>
    {{ config('app.name') }}
@endcomponent
