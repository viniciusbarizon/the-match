<x-guest-layout>
    <div class="mb-4">
        {{ __('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o
            processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.') }}
    </div>

    @livewire('job-seeker.verification-code.send')
    @livewire('job-seeker.verification-code.verify')

    @livewire('job-seeker.create-or-edit.url')

    <x-contract/>
</x-guest-layout>
