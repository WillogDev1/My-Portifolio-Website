const url_Perfil     = '/perfil/atualiza-senha'
const metodo        = 'POST'


function send_Fetch_Change_Password()
{
    var formData = new FormData();

    formData.append(
        "oldPassword",
        document.getElementById("oldPassword").value
      );
    formData.append(
        "newPassword",
        document.getElementById("newPassword").value
      );
      formData.append(
        "confirmNewPassword",
        document.getElementById("confirmNewPassword").value
      );

      console.log(formData);

      fetch(url_Perfil, {
        method: metodo,
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.success && data.redirect){
            window.location.href = data.redirect;
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