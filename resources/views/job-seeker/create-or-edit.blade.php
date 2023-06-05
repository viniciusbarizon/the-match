<x-guest-layout>
    <div class="space-y-4">
        <div>
            {{ __('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o
                processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.') }}
        </div>

        @livewire('job-seeker.verification-code.send')
        @livewire('job-seeker.verification-code.verify')

        @livewire('job-seeker.create-or-edit.url')

        <x-contract/>
        <x-currency/>
        <x-job-seeker.salary-requirement/>
    </div>
</x-guest-layout>
