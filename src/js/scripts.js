document.addEventListener("DOMContentLoaded", (event) => {
  const sendButton = document.getElementById("send-button");
  const chatInput = document.getElementById("chat-input");
  const chatPopover = document.getElementById("chat-popover");

  sendButton.addEventListener("click", function () {
    let message = document.getElementById("chat-input").value.trim();
    if (message !== "") {
      sendQuestion(message);
    }
  });
  chatInput.addEventListener("keypress", function (event) {
    let message = this.value;
    if (event.key === "Enter") {
      if (message !== "") {
        sendQuestion(message);
        document.getElementById("chat-popover").hidePopover();
      }
    }
  });
});

function sendQuestion(message) {
  let url = "http://localhost:8080/api/send_question.php?message=" + message;

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      document.getElementById("chat-input").value = "";
      document.getElementById("info-popover").showPopover();
      console.log("The message was sent successfully.");
    }
  };
  xmlHttp.open("GET", url, true); // true for asynchronous
  xmlHttp.send(null);
}
