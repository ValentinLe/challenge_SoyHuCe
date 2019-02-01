

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
  for (let jsonSong in data["results"]) {
    res += getHTMLSong(data["results"][jsonSong])
  }
  document.getElementsByClassName("listSong")[0].innerHTML = res;
}

function getHTMLSong(jsonSong) {
  let duree = new Date(jsonSong["trackTimeMillis"]);
  return (
    "<div class='item'>" +
      "<span class='time'>" + duree.getMinutes() + ":" + duree.getSeconds() + "</span>" +
      "<span class='trackName'>" + jsonSong["trackName"] + "</span>" +
      "<span class='artistName'>" + jsonSong["artistName"] + "</span>" +
      "<audio controls src=" + jsonSong["previewUrl"] + "></audio>" +
      "<button>Voir page</button>" +
    "</div>"
  );
}

window.onload = main;

function main() {
  let bSearch = document.getElementById("bSearch");
  bSearch.onclick = () => {
    let input = document.getElementById("entry");
    let text = input.value;
    if (text !== "") {
      document.getElementsByClassName("listSong")[0].innerHTML = "";
      let url = "https://itunes.apple.com/search?term=" + text + "&limit=20&entity=song";
      let value = requestJson(url, (data) => (visu(data)));
    }
  }
}
