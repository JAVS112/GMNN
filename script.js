let secretWord = "";
let definition = "";
let hint = "";
let selectedDifficulty = "";
let difficulty = "";

let lives = 3;
let score = 0;
let wrongAttempts = 0;

let wordsSolved = Number(localStorage.getItem("wordsSolved")) || 0;
let highestScore = Number(localStorage.getItem("highestScore")) || 0;

const highestScoreDisplay = document.querySelector("#highestScore");
const wordsSolvedDisplay = document.querySelector("#wordsSolved");

const introduction = document.querySelector(".introduction");
const game = document.querySelector(".game");

const wordDisplay = document.querySelector(".word");
const hintDisplay = document.querySelector(".hint");

const scoreDisplay = document.querySelector("#score");
const livesDisplay = document.querySelector("#lives");

const answerInput = document.querySelector("#answerInput");
const submitAnswerButton = document.querySelector("#submitAnswer");
const hintButton = document.querySelector("#hintButton");
const hintPopup = document.querySelector("#hintPopup");
const hintText = document.querySelector("#hintText");
const closeHint = document.querySelector("#closeHint");

const backMenu = document.querySelector("#backMenu");
const exitPopup = document.querySelector("#exitPopup");
const cancelExit = document.querySelector("#cancelExit");
const confirmExit = document.querySelector("#confirmExit");

const difficultyButtons = document.querySelectorAll(".difficulty-button");

const scoreStat = document.querySelector("#scoreStat");
const livesStat = document.querySelector("#livesStat");

const gameOver = document.querySelector("#gameOver");
const gameOverMenu = document.querySelector("#gameOverMenu");

const finalScore = document.querySelector("#finalScore");
const finalWordsSolved = document.querySelector("#finalWordsSolved");
const finalHighestScore = document.querySelector("#finalHighestScore");

/* =========================
DIFFICULTY / START GAME
========================= */

difficultyButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    selectedDifficulty = button.dataset.difficulty;

    console.log("Selected difficulty:", selectedDifficulty);

    // Reset current game
    score = 0;
    lives = 3;
    wrongAttempts = 0;
    secretWord = "";

    introduction.style.display = "none";
    game.style.display = "block";

    scoreStat.style.display = "block";
    livesStat.style.display = "block";

    updateScore();
    updateLives();

    startNewRound();
  });
});

/* =========================
GET RANDOM WORD
========================= */

async function startNewRound() {
  wrongAttempts = 0;

  updateLives();
  updateScore();

  wordDisplay.textContent = "TYPE YOUR ANSWER BELOW";

  hintDisplay.innerHTML = "Loading definition...";

  answerInput.value = "";
  answerInput.disabled = false;

  submitAnswerButton.disabled = false;

  hintPopup.style.display = "none";

  try {
    /*
     * Send the previous word and selected
     * difficulty to PHP.
     */

    const response = await fetch(
      "get_word.php?previous=" +
        encodeURIComponent(secretWord) +
        "&difficulty=" +
        encodeURIComponent(selectedDifficulty),
    );

    const text = await response.text();

    console.log("SERVER RESPONSE:");
    console.log(text);

    const data = JSON.parse(text);

    if (!data.success) {
      hintDisplay.textContent = "Could not load a word.";

      console.error("PHP ERROR:", data.message);

      return;
    }

    console.log("New word loaded:", data.word);

    secretWord = data.word.toUpperCase();

    definition = data.definition;

    hint = data.hint;

    difficulty = data.difficulty;

    hintDisplay.innerHTML = `<strong>DEFINITION:</strong> ${definition}
        <br>
        <span class="difficulty">
            Difficulty: ${difficulty}
        </span>`;

    answerInput.focus();
  } catch (error) {
    console.error(error);

    hintDisplay.textContent = "Unable to connect to the game server.";
  }
}

/* =========================
AUTOMATIC UPPERCASE
========================= */

answerInput.addEventListener("input", function () {
  answerInput.value = answerInput.value.toUpperCase();
});

/* =========================
SUBMIT ANSWER
========================= */

submitAnswerButton.addEventListener("click", checkAnswer);

answerInput.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    checkAnswer();
  }
});

/* =========================
CHECK ANSWER
========================= */

function checkAnswer() {
  const playerAnswer = answerInput.value.trim().toUpperCase();

  if (playerAnswer === "") {
    alert("Please enter your answer.");

    return;
  }

  if (playerAnswer === secretWord) {
    winGame();
  } else {
    wrongAttempts++;

    lives--;

    updateLives();

    answerInput.value = "";

    answerInput.focus();

    if (lives <= 0) {
      loseGame();
    } else {
      hintDisplay.innerHTML = `
        <strong>DEFINITION:</strong> ${definition}
        <br>
        <span class="difficulty">
          Difficulty: ${difficulty}
        </span>
        <br><br>
        <strong>Not quite!</strong>
        Try again. You have ${lives} ${lives === 1 ? "life" : "lives"} left.
      `;
    }
  }
}

/* =========================
HINT
========================= */
hintButton.addEventListener("click", function () {
  if (!secretWord) {
    return;
  }

  hintText.textContent = hint || "No hint is available for this word.";

  hintPopup.style.display = "flex";
});

/* =========================
CLOSE HINT
========================= */

closeHint.addEventListener("click", function () {
  hintPopup.style.display = "none";
});

/* =========================
WIN
========================= */

function winGame() {
  let points = 100;

  if (wrongAttempts === 1) {
    points = 75;
  } else if (wrongAttempts === 2) {
    points = 50;
  }

  score += points;
  wordsSolved++;

  if (score > highestScore) {
    highestScore = score;
  }

  localStorage.setItem("highestScore", highestScore);
  localStorage.setItem("wordsSolved", wordsSolved);

  updateScore();
  updateRecords();

  wordDisplay.textContent = secretWord;

  hintDisplay.innerHTML = `🎉 <strong>Correct!</strong>
        You earned ${points} points.`;

  answerInput.disabled = true;
  submitAnswerButton.disabled = true;

  setTimeout(function () {
    startNewRound();
  }, 1000);
}

/* =========================
LOSE
========================= */

function loseGame() {
  game.style.display = "none";
  gameOver.style.display = "block";

  finalScore.textContent = score;
  finalWordsSolved.textContent = wordsSolved;
  finalHighestScore.textContent = highestScore;

  scoreStat.style.display = "none";
  livesStat.style.display = "none";
}

/* =========================
BACK TO MENU
========================= */
gameOverMenu.addEventListener("click", function () {
  gameOver.style.display = "none";
  introduction.style.display = "block";

  score = 0;
  lives = 3;
  wrongAttempts = 0;

  updateScore();
  updateLives();
  updateRecords();
});

function updateRecords() {
  highestScoreDisplay.textContent = highestScore;
  wordsSolvedDisplay.textContent = wordsSolved;
}

/* =========================
EXIT GAME POPUP
========================= */

backMenu.addEventListener("click", function () {
  exitPopup.style.display = "flex";
});

cancelExit.addEventListener("click", function () {
  exitPopup.style.display = "none";
});

confirmExit.addEventListener("click", function () {
  exitPopup.style.display = "none";

  game.style.display = "none";
  introduction.style.display = "block";

  score = 0;
  lives = 3;
  wrongAttempts = 0;
  secretWord = "";

  scoreStat.style.display = "none";
  livesStat.style.display = "none";

  updateScore();
  updateLives();
});

/* =========================
UPDATE LIVES
========================= */

function updateLives() {
  let hearts = "";

  for (let i = 0; i < lives; i++) {
    hearts += "♥ ";
  }

  livesDisplay.textContent = hearts.trim();
}

/* =========================
UPDATE SCORE
========================= */

function updateScore() {
  scoreDisplay.textContent = score;
}

updateRecords();
