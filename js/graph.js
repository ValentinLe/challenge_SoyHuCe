
window.onload = () => {
  let ctx = document.getElementById("myChart").getContext('2d');

  // la bordure doit avoir la meme couleur que le fond mais avec un opacité de 1
  // et le fond de 0.2
  let color = generateNColor(labels.length);
  // liste rgba pour background
  let colorRGBA_back = generateNRGBA(color, 0.2);
  // liste rgba pour border
  let colorRGBA_border = generateNRGBA(color, 1);

  let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Genres musicaux',
            data: values,
            backgroundColor: colorRGBA_back,
            borderColor: colorRGBA_border,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        responsive: true,
        maintainAspectRatio: true,
    }
  });
}

/*
  genere une couleur aléatoire sous forme de liste
  ex : [220, 174, 52]
*/
function getRandomColor() {
    var color = [];
    for (let i = 0; i<3; i++) {
      color.push(getRandomInt(0,256));
    }
    return color;
}

/*
  genere N couleur sous forme de liste
*/
function generateNColor(n) {
  let listColor = [];
  for (let i = 0; i < n; i++) {
    listColor.push(getRandomColor());
  }
  return listColor;
}

/*
  passe d'une liste rgb à une string rgba avec l'absorbance donnee
  ex: ([220, 174, 52], 0.4) => "rgba(220, 174, 52, 0.4)"
*/
function createRGBAColor(listRGB, a) {
  return "rgba(" + listRGB[0] + ", " + listRGB[1] + ", " + listRGB[2] + ", " + a + ")";
}

/*
  genere N string rgba sur une liste rgb avec l'absorbance donnee
*/
function generateNRGBA(listRGB, a) {
  let listRGBA = [];
  for (let i = 0; i < listRGB.length; i++) {
    listRGBA.push(createRGBAColor(listRGB[i], a));
  }
  return listRGBA
}

/*
  genere un entier entre min inclus et max exclus
  src : https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Objets_globaux/Math/random
*/
function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}
