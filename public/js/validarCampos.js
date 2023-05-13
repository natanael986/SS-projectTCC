const form = document.querySelector('form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const usernameError = document.getElementById('username-error');
const passwordError = document.getElementById('password-error');

form.addEventListener('submit', async (event) => {
  event.preventDefault(); // impedir envio padrão do formulário
  
  const username = usernameInput.value.trim();
  const password = passwordInput.value;
  
  // fazer a validação preliminar do nome
  if (await checkIfUsernameExists(username)) {
    displayError('username', 'Esse nome de usuário já está sendo usado');
    return false;
  }
  
  // fazer a validação preliminar da senha
  if (!isValidPassword(password)) {
    displayError('password', 'A senha deve ter pelo menos 8 caracteres e conter pelo menos uma letra maiúscula, uma letra minúscula e um número');
    return false;
  }
  
  // enviar o formulário se todas as validações passarem
  form.submit();
});

async function checkIfUsernameExists(username) {
    const response = await fetch('check-username.php', {
      method: 'POST',
      body: JSON.stringify({ username }),
      headers: { 'Content-Type': 'application/json' }
    });
  
    const data = await response.json();
    return data.exists;
  }

function isValidPassword(password) {
  const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
  return regex.test(password);
}

function displayError(field, message) {
  const errorElement = document.getElementById(`${field}-error`);
  errorElement.innerHTML = message;
  errorElement.classList.add('error');
  if (field === 'username') {
    usernameInput.classList.add('error');
  } else if (field === 'password') {
    passwordInput.classList.add('error');
  }
  
  return false;
}