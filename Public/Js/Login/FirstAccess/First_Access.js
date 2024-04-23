const url_Login     = '/login/firstaccess'
const metodo        = 'POST'


function send_Fetch_First_Access()
{
    var formData = new FormData();

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