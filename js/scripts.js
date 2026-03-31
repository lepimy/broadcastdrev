document.addEventListener("DOMContentLoaded", (event) => {
  const sendButton = document.getElementById("send-button");

  if (flvjs.isSupported()) {
    var videoElement = document.getElementById("videoElement");
    var flvPlayer = flvjs.createPlayer({
      type: "flv",
      url: "http://localhost:8000/live/my_stream.flv",
    });
    flvPlayer.attachMediaElement(videoElement);
    flvPlayer.load();
    flvPlayer.play();
  }

  sendButton.addEventListener("click", function () {
    let message = document.getElementById("chat-input").value.trim();
    if (message !== "") {
      sendQuestion(message);
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
