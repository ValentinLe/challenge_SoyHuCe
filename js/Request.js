

function requestJson(url, callback) {
  let json;

  let init = {
    method: "GET",
    mode: "cors",
    cache: "default"
  };

  let request = new Request(url, init);
  json = fetch(request)
  .then((response) => { return response.json(); })
  .then(callback);
}

function visu(data) {
  let res = "";
  console.log(data["results"]);
  if (data["results"]["length"] !== 0) {
    setMessage("");
    for (let jsonSong in data["results"]) {
      res += getHTMLSong(data["results"][jsonSong])
    }
    setResults(res);
  } else {
    setMessage("Aucun résultat pour cette recherche");
  }
}

function setResults(htmlString) {
  document.getElementsByClassName("listSong")[0].innerHTML = htmlString;
}

function setMessage(message) {
  document.getElementById("message").innerHTML = message;
}

function getHTMLSong(jsonSong) {
  let duree = new Date(jsonSong["trackTimeMillis"]);
  let minutes = "" + duree.getMinutes();
  let secondes = duree.getSeconds();
  secondes = "" + (secondes<10 ? "0" + secondes : secondes);
  return (
    "<div class='item'>" +
      "<span class='time'>" + minutes + ":" + secondes + "</span>" +
      "<span class='trackName'>" + jsonSong["trackName"] + "</span>" +
      "<span class='artistName'>" + jsonSong["artistName"] + "</span>" +
      "<div class='zoneAudio'><audio controls src=" + jsonSong["previewUrl"] + "></audio></div>" +
      "<button>Voir page</button>" +
    "</div>"
  );
}

window.onload = main;

function main() {
  let bSearch = document.getElementById("bSearch");
  //$.post("index.php", {test: "oulala"}, () => {});
  bSearch.onclick = () => {
    let input = document.getElementById("entry");
    let text = input.value;
    if (text !== "") {
      setMessage("");
      let url = "https://itunes.apple.com/search?term=" + text + "&limit=20&entity=song";
      let value = requestJson(url, (data) => (visu(data)));
    } else {
      setMessage("Veuillez Entrer une recherche");
    }
  }
}
