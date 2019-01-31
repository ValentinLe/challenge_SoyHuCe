

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
  if (jsonSong["kind"] === "song") {
    return "<audio controls src=" + jsonSong["previewUrl"] + " ></audio>";
  } else {
    return "<video controls src=" + jsonSong["previewUrl"] + "></video>";
  }
}

let url = "https://itunes.apple.com/search?term=patrick+sebastien&limit=10&entity=song";
let key = "YV95cmKnvDy9GO5BEYeS70pHYwZHy2QktYbGRx8R";
let value = requestJson(url, (data) => (visu(data)));
