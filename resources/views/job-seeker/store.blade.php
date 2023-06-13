<x-guest-layout>
    <div class="space-y-8">
        <p class="font-bold">
            {{ __('Seu perfil foi criado com sucesso!') }}
        </p>

        <p>
            {{ __('Guarde o link para compartilhar com as empresas:') }}

            <a href="{{ route('job-seekers.match', ['slug' => $slug]) }}" target="_blank">
                {{ route('job-seekers.match', ['slug' => $slug]) }}
            </a>
        </p>

        <p>
            {{ __('Enviaremos para o seu e-mail os matches feitos pelas empresas.') }}
        </p>
    </div>
</x-guest-layout>
