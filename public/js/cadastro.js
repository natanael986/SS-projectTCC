const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

// Verifica se a chave "PainelFixo" existe no sessionStorage
if (sessionStorage.getItem("PainelFixo") == "true") {
  // Se existir, adiciona a classe "right-panel-active" no container
  container.classList.add("right-panel-active");
}

signUpButton.addEventListener('click', () => {
  // Adiciona a classe "right-panel-active" no container
  container.classList.add("right-panel-active");
  // Salva o estado do painel fixo no sessionStorage
  sessionStorage.setItem("PainelFixo", "true");
});

signInButton.addEventListener('click', () => {
  // Remove a classe "right-panel-active" do container
  container.classList.remove("right-panel-active");
  // Salva o estado do painel fixo no sessionStorage
  sessionStorage.setItem("PainelFixo", "false");
});