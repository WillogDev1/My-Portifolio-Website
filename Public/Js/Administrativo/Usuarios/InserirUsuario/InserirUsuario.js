const url_Criar_Usuario     = '/administrativo/usuarios/inserirusuario'
const metodo        = 'POST'


function send_Fetch_Criar_Usuario()
{
    var formData = new FormData();

    formData.append(
        "nomeCompleto",
        document.getElementById("nomeCompleto").value
      );
    formData.append(
        "email",
        document.getElementById("email").value
      );
      formData.append(
        "cpf",
        document.getElementById("cpf").value
      );
      formData.append(
        "password",
        document.getElementById("password").value
      );

      console.log(formData);

      fetch(url_Criar_Usuario, {
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