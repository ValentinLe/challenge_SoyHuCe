

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
  console.log(data);
}
let url = "https://itunes.apple.com/search?term=catchu&limit=100";
let key = "YV95cmKnvDy9GO5BEYeS70pHYwZHy2QktYbGRx8R";
let value = requestJson(url, (data) => (visu(data)));
