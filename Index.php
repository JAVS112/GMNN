<!doctype html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Word Guess</title>

    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <!-- Header -->
    <header class="header">
      <div class="logo">WORD<span>GUESS</span></div>

      <div class="game-stats">
        <div class="stat">
          <span class="stat-label">SCORE</span>
          <span class="stat-value">120</span>
        </div>

        <div class="stat">
          <span class="stat-label">LIVES</span>
          <span class="stat-value lives">♥ ♥ ♥</span>
        </div>
      </div>
    </header>

    <!-- Introduction -->
    <main class="game-container">
      <section class="game-card introduction">
        <div class="game-heading">
          <p class="small-title">WELCOME TO</p>

          <h1>WORDGUESS</h1>

          <p class="description">Think you know your words?</p>
        </div>

        <div class="intro-text">
          <p>
            Test your vocabulary, solve the clues, and uncover the hidden word.
          </p>

          <p>
            You have <strong>3 lives</strong>. Choose your guesses carefully!
          </p>
        </div>

        <button class="start-game">START GAME</button>
      </section>

      <!-- Main Game -->
      <section class="game-card game" style="display: none">
        <!-- Game Title -->
        <div class="game-heading">
          <p class="small-title">CAN YOU UNCOVER IT?</p>

          <h1>GUESS THE WORD</h1>

          <p class="description">Use the hint to uncover the hidden word.</p>
        </div>

        <!-- Word -->
        <div class="word-area">
          <div class="word">
            <span>_</span>
            <span>_</span>
            <span>_</span>
            <span>_</span>
            <span>_</span>
            <span>_</span>
          </div>

          <p class="hint">💡 Hint: <strong>An animal</strong></p>
        </div>

        <!-- Guess Input -->
        <div class="guess-area">
          <button class="guess-button">GUESS</button>
        </div>

        <!-- New Game -->
        <button class="new-game">↻ &nbsp; NEW GAME</button>
      </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
      <p>© <?php echo date("Y"); ?> WordGuess. Have fun!</p>
    </footer>

    <!-- Start Game Script -->
    <script>
      const introduction = document.querySelector(".introduction");
      const game = document.querySelector(".game");
      const startGameButton = document.querySelector(".start-game");

      startGameButton.addEventListener("click", function () {
        introduction.style.display = "none";
        game.style.display = "block";
      });
    </script>
  </body>
</html>
