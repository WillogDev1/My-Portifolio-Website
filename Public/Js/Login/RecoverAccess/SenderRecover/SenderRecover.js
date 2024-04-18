const url_Sender_Email      = '/login/recoveraccess/senderrecoveremail'
const metodo                = 'POST'


function send_Fetch_Sender_Email()
{
    var formData = new FormData();

    formData.append(
        "email_Recover",
        document.getElementById("email_Recover").value
      );

      //console.log(formData);

      fetch(url_Sender_Email, {
        method: metodo,
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
          if(data.success){
            alert(data.message);
            //window.location.href = data.redirect;
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