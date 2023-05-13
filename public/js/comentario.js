const commentButton = document.getElementById('commentButton');
const commentContainer = document.getElementById('commentContainer');

// Verifica se a chave "PainelFixo" existe no sessionStorage
if (sessionStorage.getItem("PainelFixo") == "true") {
    // Se existir, adiciona a classe "active" no container
    commentContainer.classList.add("active");
}

commentButton.addEventListener('click', () => {
    // Alterna a classe "active" no container
    commentContainer.classList.toggle("active");

    // Salva o estado do painel fixo no sessionStorage
    sessionStorage.setItem("PainelFixo", commentContainer.classList.contains("active"));
});

// Restaura o estado do painel fixo quando a página for carregada
window.addEventListener('load', () => {
    if (sessionStorage.getItem("PainelFixo") == "true") {
        commentContainer.classList.add("active");
    }
});