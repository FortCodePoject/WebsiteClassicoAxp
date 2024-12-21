@if (isset($terms) && isset($terms->accept) && $terms->accept === 'yes')
    <p class="text-success">Termos PB aceites.</p>
@else
    <p class="text-danger">Termos PB rejeitados</p>
    <div class="mb-2">
        <button data-toggle="modal" data-target="#termsCompany" class=" btn btn-primary bg-white text-primary">Cadastrar meus termos</button>                           
        <button data-toggle="modal" data-target="#readMyTerms" class=" btn btn-primary bg-white text-primary" wire:click="loadTerms()">Ler termos</button>
    </div>
@endif
<button data-toggle="modal" data-target="#read" class="btn btn-primary bg-white text-primary">Ler termos PB</button>
<svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
</svg>