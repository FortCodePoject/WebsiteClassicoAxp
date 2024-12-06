<style>
    :root {
        --hero: url('{{ isset($imageHero->image) ? asset("storage/arquivos/background/".$imageHero->image) : '' }}');
        --start: url('{{ isset($start->image) ? asset("storage/arquivos/background/".$start->image) : '' }}');
        --footer: url('{{ isset($footer->image) ? asset("storage/arquivos/background/".$footer->image) : '' }}');
        --shoppingCart: url('{{ isset($shoppingCart->image) ? asset("storage/".$shoppingCart->image) : '' }}');
        --shopping: url('{{ isset($shopping->image) ? asset("storage/arquivos/background/".$shopping->image) : '' }}');
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