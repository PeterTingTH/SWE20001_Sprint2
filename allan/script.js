function openForm() {
    document.getElementById("cancelForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("cancelForm").style.display = "none";
  }

  window.onclick = function (event) {
    let modal = document.getElementById('cancelForm');
    if (event.target == modal) {
      closeForm();
    }
  }