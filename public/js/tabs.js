function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Esconde todos os conteúdos
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove a classe "active" de todos os botões
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Mostra o conteúdo selecionado
    document.getElementById(tabName).style.display = "block";
    
    // Adiciona a classe "active" ao botão clicado
    evt.currentTarget.classList.add("active");
}