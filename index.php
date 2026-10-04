<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Word Guess</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Header -->
    <header class="header">

        <div class="logo">
            WORD<span>GUESS</span>
        </div>

        <div class="game-stats">

            <div class="stat">
                <span class="stat-label">SCORE</span>
                <span class="stat-value" id="score">0</span>
            </div>

            <div class="stat">
                <span class="stat-label">LIVES</span>
                <span class="stat-value lives" id="lives">♥ ♥ ♥</span>
            </div>

        </div>

    </header>


    <!-- Main -->
    <main class="game-container">


        <!-- =========================
             INTRODUCTION
        ========================== -->

        <section class="game-card introduction">

            <div class="game-heading">

                <p class="small-title">WELCOME TO</p>

                <h1>WORDGUESS</h1>

                <p class="description">
                    Think you know your words?
                </p>

            </div>


            <div class="intro-text">

                <p>
                    Test your vocabulary, solve the clues,
                    and uncover the hidden word.
                </p>

                <p>
                    You have <strong>3 lives</strong>.
                    Choose your guesses carefully!
                </p>

            </div>


            <button
                class="start-game"
                type="button"
            >
                START GAME
            </button>

        </section>



        <!-- =========================
             MAIN GAME
        ========================== -->

        <section
            class="game-card game"
            style="display: none;"
        >

            <div class="game-heading">

                <p class="small-title">
                    CAN YOU FIGURE IT OUT?
                </p>

                <h1>
                    GUESS THE WORD
                </h1>

                <p class="description">
                    Use the definition to figure out
                    the hidden word.
                </p>

            </div>


            <!-- Word -->
            <div class="word-area">

                <div class="word" id="word">
                    <span>_</span>
                </div>


                <p class="hint" id="hint">
                    Definition loading...
                </p>

            </div>


            <!-- Guess -->
            <div class="guess-area">

                <input
                    type="text"
                    id="guessInput"
                    class="guess-input"
                    maxlength="1"
                    placeholder="A"
                    autocomplete="off"
                >

                <button
                    class="guess-button"
                    id="guessButton"
                    type="button"
                >
                    GUESS
                </button>

            </div>


            <!-- New Game -->
            <button
                class="new-game"
                id="newGame"
                type="button"
            >
                ↻ &nbsp; NEW GAME
            </button>

        </section>

    </main>



    <!-- Footer -->
    <footer class="footer">

        <p>
            © <?php echo date("Y"); ?> WordGuess.
            Have fun!
        </p>

    </footer>



    <!-- JavaScript -->
    <script src="script.js"></script>

</body>
</html>