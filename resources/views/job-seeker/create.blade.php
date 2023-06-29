<x-guest-layout>
    <div class="space-y-4">
        <div>
            {{ __('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o
                processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.') }}
        </div>

        <form action="{{ route('job-seekers.store') }}" class="space-y-4" method="POST">
            @csrf

            @livewire('job-seeker.create.code.send')
            @livewire('job-seeker.create.code.verify')

            @livewire('job-seeker.create.url')

            <x-job-seeker.salary-requirement/>

            <x-primary-button id="create_profile">
                {{ __('Criar Perfil') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
