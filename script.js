let secretWord = "";
let definition = "";
let difficulty = "";

let guessedLetters = [];
let lives = 3;
let score = 0;

const introduction = document.querySelector(".introduction");
const game = document.querySelector(".game");
const startGameButton = document.querySelector(".start-game");

const wordDisplay = document.querySelector(".word");
const hintDisplay = document.querySelector(".hint");

const scoreDisplay = document.querySelector("#score");
const livesDisplay = document.querySelector("#lives");

const guessInput = document.querySelector("#guessInput");
const guessButton = document.querySelector("#guessButton");

const newGameButton = document.querySelector(".new-game");

/* =========================
   START GAME
========================= */

startGameButton.addEventListener("click", function () {
  introduction.style.display = "none";
  game.style.display = "block";

  startNewRound();
});

/* =========================
   GET RANDOM WORD
========================= */

async function startNewRound() {
  lives = 3;
  guessedLetters = [];

  updateLives();
  updateScore();

  wordDisplay.innerHTML = "";

  hintDisplay.innerHTML = "Loading definition...";

  guessInput.value = "";
  guessInput.disabled = false;
  guessButton.disabled = false;

  try {
    const response = await fetch("get_word.php");

    const data = await response.json();

    if (!data.success) {
      hintDisplay.textContent = "Could not load a word.";
      console.error(data.message);
      return;
    }

    secretWord = data.word.toUpperCase();
    definition = data.definition;
    difficulty = data.difficulty;

    hintDisplay.innerHTML = `<strong>DEFINITION:</strong> ${definition}
             <br>
             <span class="difficulty">Difficulty: ${difficulty}</span>`;

    displayWord();
  } catch (error) {
    console.error(error);

    hintDisplay.textContent = "Unable to connect to the game server.";
  }
}

/* =========================
   DISPLAY HIDDEN WORD
========================= */

function displayWord() {
  wordDisplay.innerHTML = "";

  for (let letter of secretWord) {
    const letterSpan = document.createElement("span");

    if (guessedLetters.includes(letter)) {
      letterSpan.textContent = letter;
    } else {
      letterSpan.textContent = "_";
    }

    wordDisplay.appendChild(letterSpan);
  }
}

/* =========================
   GUESS LETTER
========================= */

guessButton.addEventListener("click", makeGuess);

guessInput.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    makeGuess();
  }
});

function makeGuess() {
  const letter = guessInput.value.trim().toUpperCase();

  guessInput.value = "";

  if (letter.length !== 1 || !/^[A-Z]$/.test(letter)) {
    alert("Please enter one letter.");

    return;
  }

  if (guessedLetters.includes(letter)) {
    alert("You already guessed that letter.");

    return;
  }

  guessedLetters.push(letter);

  if (secretWord.includes(letter)) {
    score += 10;

    updateScore();

    displayWord();

    if (hasWon()) {
      winGame();
    }
  } else {
    lives--;

    updateLives();

    if (lives <= 0) {
      loseGame();
    }
  }
}

/* =========================
   CHECK WIN
========================= */

function hasWon() {
  for (let letter of secretWord) {
    if (!guessedLetters.includes(letter)) {
      return false;
    }
  }

  return true;
}

/* =========================
   WIN
========================= */

function winGame() {
  wordDisplay.innerHTML = "";

  for (let letter of secretWord) {
    const letterSpan = document.createElement("span");

    letterSpan.textContent = letter;

    wordDisplay.appendChild(letterSpan);
  }

  hintDisplay.innerHTML = `🎉 <strong>Correct!</strong> The word was ${secretWord}.`;

  guessInput.disabled = true;
  guessButton.disabled = true;

  score += 50;

  updateScore();
}

/* =========================
   LOSE
========================= */

function loseGame() {
  wordDisplay.innerHTML = "";

  for (let letter of secretWord) {
    const letterSpan = document.createElement("span");

    letterSpan.textContent = letter;

    wordDisplay.appendChild(letterSpan);
  }

  hintDisplay.innerHTML = `😢 <strong>Game Over!</strong> The word was ${secretWord}.`;

  guessInput.disabled = true;
  guessButton.disabled = true;
}

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

/* =========================
   NEW GAME
========================= */

newGameButton.addEventListener("click", function () {
  startNewRound();
});
