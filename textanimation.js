const textAnim = document.querySelector("h1");


const typewriter1 = new Typewriter(textAnim, {
    loop: false,
    deleteSpeed:0
})
.typeString("Bienvenue dans Quizzeo")
.pauseFor(300)
.start()
.callFunction(() => {
  typewriter1.stop();
});


