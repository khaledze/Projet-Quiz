const textAnim = document.querySelector("h1");
const textAnim2 = document.querySelector("h2");

const typewriter1 = new Typewriter(textAnim, {
    loop: false,
    deleteSpeed:0
})
.typeString("Bienvenue dans notre Jeu Quizzeo")
.pauseFor(300)
.start()
.callFunction(() => {
  typewriter1.stop();
});

const typewriter2 = new Typewriter(textAnim2, {
    loop: false,
    deleteSpeed:20
})
.changeDelay(50)
.typeString("Notre jeu de quiz en ligne est un moyen amusant et interactif de tester vos connaissances sur divers sujets.")
.pauseFor(300)
.typeString("Avec plusieurs questions couvrant une variété de catégories, y compris la science, la géographie, l'histoire etc, il y a quelque chose pour tout le monde.")
.pauseFor(300)
.typeString("Chaque question comporte quatre réponses possibles, et vous avez 60 secondes pour sélectionner la bonne réponse.")
.pauseFor(300)
.typeString("Votre score est enregistré à chaque question, vous permettant de suivre votre progression au fil du temps.")
.pauseFor(300)
.typeString("Notre plateforme est conçue pour être facile à utiliser, avec une interface conviviale et intuitive.")
.pauseFor(300)
.typeString("En plus de vous offrir un défi stimulant, notre jeu de quiz en ligne vous aide également à améliorer vos connaissances.")
.pauseFor(300)
.typeString("Vous pouvez découvrir de nouvelles informations intéressantes et enrichissantes tout en jouant.")
.start()
.callFunction(() => {
  typewriter2.stop();
});
