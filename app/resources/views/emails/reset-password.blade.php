@component('mail::message')
    <h3> Ваш новый пароль для входа в приложение</h3>
    <ul>
        <li>Новый пароль: <b>{{$newPassword}}</b></li>
        <li>Ваш email: {{$email}}</li>
    </ul>

    {{ config('app.name') }}
@endcomponent
