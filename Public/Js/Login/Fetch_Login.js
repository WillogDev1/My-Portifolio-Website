const url_Login     = '/login'
const metodo        = 'POST'


function send_Fetch()
{
    var formData = new FormData();

    formData.append(
        "username",
        document.getElementById("username").value
      );
    formData.append(
        "password",
        document.getElementById("password").value
      );

      console.log(formData);

      fetch(url_Login, {
        method: metodo,
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
        console.log("Sucesso:", data);
        //window.location.reload();
      })
      .catch(error => {
        console.error("Erro:", error);
        //window.location.reload();
      });
}