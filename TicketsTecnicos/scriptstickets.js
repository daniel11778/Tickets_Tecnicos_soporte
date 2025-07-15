
function hora_de_apertura(){
    

const ahora = new Date();

  const año = ahora.getFullYear();
  const mes = String(ahora.getMonth() + 1).padStart(2, '0');
  const dia = String(ahora.getDate()).padStart(2, '0');
  const horas = String(ahora.getHours()).padStart(2, '0');
  const minutos = String(ahora.getMinutes()).padStart(2, '0');

  const fecha_apertura = `${año}-${mes}-${dia} ${horas}:${minutos}`;

  document.getElementById("fecha_apertura").value = fecha_apertura;
  }