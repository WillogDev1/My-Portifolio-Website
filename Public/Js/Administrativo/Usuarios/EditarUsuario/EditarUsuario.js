const url_Update_User     = '/administrativo/usuarios/editarusuario';
const url_Update_Permissao = '/administrativo/usuarios/editarusuario/updatepermissao';
const metodo        = 'POST'

function send_Fetch_Editar_Usuario()
{
    var formData = new FormData();
    const urlParams = new URLSearchParams(window.location.search);
    const USER_ID = urlParams.get('userId');

    formData.append(
        "novoNome",
        document.getElementById("novoNome").value
      );
    formData.append(
        "novoEmail",
        document.getElementById("novoEmail").value
      );
    formData.append(
        "USER_ID",
        USER_ID
      );

      console.log(formData);

      fetch(url_Update_User, {
        method: metodo,
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.message){
            alert(data.message);
          }else{
            alert(data.message);
            console.error("Servidor: ", data.message);
          }
      })
      .catch(error => {
        console.error("Erro na requisição: ", error);
        //window.location.reload();
      });
}

function opcaoSelecionada() {
  const urlParams = new URLSearchParams(window.location.search);
  var select = document.getElementById("meuSelect");
  var opcao = select.options[select.selectedIndex].value; // Pega o texto da opção selecionada
  const USER_ID = urlParams.get('userId');

  switch (opcao) {
      case "/enviar-senha":
          enviarSenha(USER_ID);
          break;
      case "/alterar-senha":
          alterarSenha(USER_ID);
          break;
      case "/ativar-usuario":
        Ativar_Usuario(USER_ID);
          break;
      case "/desativar-usuario":
        desativar_Usuario(USER_ID);
          break;
  }
}

function enviarSenha(USER_ID) {
  var formData = new FormData();
  formData.append("userId", USER_ID);
  formData.append(
    "novoEmail",
    document.getElementById("novoEmail").value
  );
  fetch("/administrativo/usuarios/editarusuario/enviarsenha", {
      method: "POST",
      body: formData,
  })
  .then(response => response.json())
  .then(data => {
      if(data.message){
          alert(data.message);
      } else {
          alert(data.message);
          console.error("Servidor: ", data.message);
      }
  })
  .catch(error => {
      console.error("Erro na requisição: ", error);
      //window.location.reload();
  });
}

function alterarSenha(USER_ID) {
  var novaSenha = prompt("Por favor, insira a nova senha:");
  if (novaSenha !== null) {
      var formData = new FormData();
      formData.append("userId", USER_ID);
      formData.append("novaSenha", novaSenha);
      fetch("/administrativo/usuarios/editarusuario/alterarsenha", {
          method: "POST",
          body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.message){
              alert(data.message);
          } else {
              alert(data.message);
              console.error("Servidor: ", data.message);
          }
      })
      .catch(error => {
          console.error("Erro na requisição: ", error);
          //window.location.reload();
      });
  }
}

function desativar_Usuario(USER_ID) {
  let confirmacao = "Tem Certeza que deseja desativar o cadastro?";
  if (confirm(confirmacao) == true) {
      var formData = new FormData();
      formData.append("userId", USER_ID);
      fetch("/administrativo/usuarios/editarusuario/desativar", {
          method: "POST",
          body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.message){
              alert(data.message);
          }else{
              alert(data.message);
              console.error("Servidor: ", data.message);
          }
      })
      .catch(error => {
          console.error("Erro na requisição: ", error);
          //window.location.reload();
      });
  }
}

function Ativar_Usuario(USER_ID) {
  let confirmacao = "Tem Certeza que deseja Ativar o cadastro?";
  if (confirm(confirmacao) == true) {
      var formData = new FormData();
      formData.append("userId", USER_ID);
      fetch("/administrativo/usuarios/editarusuario/ativar", {
          method: "POST",
          body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.message){
              alert(data.message);
          }else{
              alert(data.message);
              console.error("Servidor: ", data.message);
          }
      })
      .catch(error => {
          console.error("Erro na requisição: ", error);
          //window.location.reload();
      });
  }
}

function atualizar_Permissao() {
  var formData = new FormData();
  const urlParams = new URLSearchParams(window.location.search);
  const USER_ID = urlParams.get('userId');
  let permissions = {};

  // Obter todos os checkboxes dos toggles
  const toggles = document.querySelectorAll("[id^='toggle_']");

  // Adicionar ao objeto permissions apenas os checkboxes alterados
  toggles.forEach(toggle => {
      const original = toggle.getAttribute('data-orig') === 'checked';
      const current = toggle.checked;

      // Verificar se houve mudança
      if (original !== current) {
          const permissionId = toggle.id.substring(7);
          permissions[permissionId] = current;
      }
  });

  // Se nenhum dado foi alterado, não fazer a requisição
  if (Object.keys(permissions).length === 0) {
      alert('Nenhuma alteração detectada.');
      return;
  }

  // Adicionando permissions como um objeto JSON
  formData.append("permissions", JSON.stringify(permissions));
  formData.append("userId", USER_ID);

  // Fazer a requisição fetch para a URL de atualização
  fetch('/administrativo/usuarios/editarusuario/updatepermissao', {
      method: 'POST', // Supondo que o método seja POST
      body: formData,
  })
  .then(response => response.json())
  .then(data => {
      if(data.message){
          alert(data.message);
      }else{
          alert("Erro: " + data.message);
          console.error("Servidor: ", data.message);
      }
  })
  .catch(error => {
      console.error("Erro na requisição: ", error);
  });
}