const AnimText = document.querySelector("h1");

const typewriter = new Typewriter(AnimText, {
     loop: true ,
     deleteSpeed:20
})
.changeDelay(50)
.typeString("Bienvenue dans notre Jeu Quizzeo")
.pauseFor(300)
.start()