const url_Login     = '/login/recoveraccess'
const metodo        = 'POST'


function send_Fetch_To_Recover_Access()
{
    var formData = new FormData();

    formData.append(
        "passwordRecover",
        document.getElementById("passwordRecover").value
      );
    formData.append(
        "password",
        document.getElementById("password").value
      );
      formData.append(
        "passwordConfirm",
        document.getElementById("passwordConfirm").value
      );

      console.log(formData);

      fetch(url_Login, {
        method: metodo,
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.success && data.redirect){
            alert(data.message);
            window.location.href = data.redirect;
          }else{
            alert(data.message);
            console.error("Servidor: ", data.message);
            window.location.href = "/login/recoveraccess"
          }
      })
      .catch(error => {
        console.error("Erro na requisição: ", error);
        //window.location.reload();
      });
}