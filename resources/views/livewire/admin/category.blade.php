<div class="col-md-12">
    <div class="card mb-4 border-0">
        <!-- Card Header - Dropdown -->
        <div class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
            <div class="col-xl-12 d-flex justify-content-between">
                <div>
                    <h5 class="card-title m-0 font-weight-bold text-white">Categoria</h5>
                </div>
                <div>
                    <button class="btn" style="background: #fff" data-toggle="modal" data-target="#addcategory">Adicionar</button>
                </div> 
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <table class="table table-striped table-responsive-md">
                <thead class="text-white" style="background: rgb(0, 74, 222)">
                  <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acções</th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($categories) && count($categories) > 0)
                        @foreach ($categories as $category)
                            @if (is_array($category) && isset($category['category'], $category['reference']))
                                <tr>
                                    <td>{{ $category['category'] }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger" wire:click="deleteCategory({{ $category['reference'] }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="12">
                                        <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 60vh">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                            </svg>
                                            <h2 class="text-muted">Nenhuma Categoria Cadastrada</h2>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">
                                <div class="col-md-12 d-flex justify-content-center align-items-center flex-column" style="height: 60vh">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    <h2 class="text-muted">Nenhuma Categoria Cadastrada</h2>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {{-- modal Start --}}
    @include("modals.create_category")
    {{-- modal End --}}
</div>