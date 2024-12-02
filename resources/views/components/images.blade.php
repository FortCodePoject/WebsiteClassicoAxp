<style>
    
    :root {
        --hero: url('{{ isset($imageHero->image) ? Storage::url("arquivos/background/".$imageHero->image) : '' }}');
        --start: url('{{ isset($start->image) ? Storage::url("arquivos/background/".$start->image) : '' }}');
        --footer: url('{{ isset($footer->image) ? Storage::url("arquivos/background/".$footer->image) : '' }}');
        --shoppingCart: url('{{ isset($shoppingCart->image) ? Storage::url("/storage/".$shoppingCart->image) : '' }}');
        --shopping: url('{{ isset($shopping->image) ? Storage::url("arquivos/background/".$shopping->image) : '' }}');
    }

    .hero {
        background-image: var(--hero);
    }

    main .section-counter {
        background-image: var(--start);
    }

    main .imgfooter {
        background-image: var(--footer);
    }

</style>