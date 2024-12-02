<style>
    :root{
        --background: {{$color->codigo ?? "red"}};
        --color: {{$color->letra ?? "#127"}};
    }

    .wrapper{
        background: var(--background);
    }

    .buttons button{
        background: #ffffff;
        color: var(--background);
    }

    #header.header-scrolled{
        background: var(--background);
    }

    .service-box:hover .ico-circle{
        background: var(--background);
    }

    .form-email input:focus,
    .form-email textarea:focus {
        border-color: var(--background);
    }

    .form-email button[type=submit] {
        background: var(--background);
    }

    .form-email button[type=submit]:hover {
        background: var(--background);
    }
    
    footer {
        background: var(--background);
    }

    a:hover {
        color: var(--background);
    }

    .color-a {
        color: var(--background);
    }

    .overlay-mf {
        background-color: var(--background);
    }

    .line-mf {
        background-color: var(--background);
    }

    .title-left:before {
        background-color: var(--background);
    }

    .socials .ico-circle {
        box-shadow: 0 0 0 3px var(--background);
    }

    .socials .ico-circle:hover {
        background-color: var(--background);
    }

    .list-ico span {
        color: var(--background);
    }

    .ico-circle {
        box-shadow: 0 0 0 10px var(--background);
   }

   .scrolltop-mf span{
        background-color: var(--background);
   }

   .back-to-top {
        background: var(--background);
   }

   .back-to-top:hover {
        background: var(--background);
    }

    #preloader:before {
        border-top: 6px solid var(--background);
    }

    .skill-mf .progress .progress-bar{
        background: var(--background);
    }
</style>