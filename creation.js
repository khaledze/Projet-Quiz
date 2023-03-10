// Fonction qui sera appelée une fois le formulaire soumis et le quiz créé avec succès
function onQuizCreated() {
  alert("Quiz créé avec succès !");
}

// Cibler le formulaire et ajouter l'événement onsubmit qui appellera la fonction onQuizCreated
var quizForm = document.getElementById("formulaire");
quizForm.onsubmit = onQuizCreated;

// // Compteur pour les questions
// let questionCount = 1;

// function ajouterQuestion() {
//   questionCount++;
  
//   // Création de l'ensemble de champs pour la nouvelle question
//   const newQuestion = `
//     <div class="question">
//       <label for="question${questionCount}">Question ${questionCount}:</label><br>
//       <input type="text" id="question${questionCount}" name="question[]"><br>

//       <label for="answer1_${questionCount}">Réponse 1:</label><br>
//       <input type="text" id="answer1_${questionCount}" name="answer1[]"><br>

//       <label for="answer2_${questionCount}">Réponse 2:</label><br>
//       <input type="text" id="answer2_${questionCount}" name="answer2[]"><br>

//       <label for="answer3_${questionCount}">Réponse 3:</label><br>
//       <input type="text" id="answer3_${questionCount}" name="answer3[]"><br>

//       <label for="correct_answer_${questionCount}">Bonne réponse:</label><br>
//       <select id="correct_answer_${questionCount}" name="correct_answer[]">
//         <option value="1">Réponse 1</option>
//         <option value="2">Réponse 2</option>
//         <option value="3">Réponse 3</option>
//       </select><br><br>
//     </div>
//   `;
  
//   // Ajout de la nouvelle question au conteneur de questions
//   const questionsContainer = document.getElementById("questions-container");
//   const newQuestionDiv = document.createElement("div");
//   newQuestionDiv.innerHTML = newQuestion;
//   questionsContainer.appendChild(newQuestionDiv);
// }
