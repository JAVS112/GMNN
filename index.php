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


        <div class="stat" id="scoreStat" style="display: none;">
            <span class="stat-label">SCORE</span>
            <span class="stat-value" id="score">0</span>
        </div>

        <div class="stat" id="livesStat" style="display: none;">
            <span class="stat-label">LIVES</span>
            <span class="stat-value lives" id="lives">♥ ♥ ♥</span>
        </div>


    </header>

    <!-- Main -->
    <main class="game-container">


        <!-- =========================
             INTRODUCTION / MENU
        ========================== -->

        <section class="game-card introduction" id="introduction">

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


            <!-- Challenge Levels -->

            <div class="challenge-section">

                <h2>CHOOSE YOUR CHALLENGE</h2>

                <div class="difficulty-buttons">

                    <button class="difficulty-button easy" data-difficulty="Easy" type="button">
                        <strong>EASY</strong>
                        <span>Common words</span>
                    </button>


                    <button class="difficulty-button medium" data-difficulty="Medium" type="button">
                        <strong>MEDIUM</strong>
                        <span>More challenging words</span>
                    </button>


                    <button class="difficulty-button hard" data-difficulty="Hard" type="button">
                        <strong>HARD</strong>
                        <span>Advanced vocabulary</span>
                    </button>

                </div>

            </div>


            <!-- Player Record -->

            <div class="record-section">

                <h2>YOUR RECORD</h2>

                <div class="record-stats">

                    <div class="record-stat">

                        <span class="record-label">
                            HIGHEST SCORE
                        </span>

                        <span class="record-value" id="highestScore">
                            0
                        </span>

                    </div>


                    <div class="record-stat">

                        <span class="record-label">
                            WORDS SOLVED
                        </span>

                        <span class="record-value" id="wordsSolved">
                            0
                        </span>

                    </div>

                </div>

            </div>

        </section>



        <!-- =========================
             MAIN GAME
        ========================== -->

        <section class="game-card game" id="game" style="display: none;">


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


            <!-- Word / Definition -->

            <div class="word-area">

                <div class="word" id="word">
                    TYPE YOUR ANSWER BELOW
                </div>


                <input type="text" id="answerInput" class="answer-input" placeholder="TYPE YOUR ANSWER"
                    autocomplete="off">


                <p class="hint" id="hint">
                    Definition loading...
                </p>

            </div>


            <!-- Buttons -->

            <div class="guess-area">

                <button class="guess-button" id="submitAnswer" type="button">
                    SUBMIT
                </button>


                <button class="hint-button" id="hintButton" type="button">
                    💡 HINT
                </button>

            </div>


            <!-- Hint Popup -->

            <div class="hint-popup" id="hintPopup">

                <div class="hint-popup-content">

                    <button class="close-hint" id="closeHint" type="button">
                        ×
                    </button>


                    <h3>💡 Hint</h3>


                    <p id="hintText">
                        Your hint will appear here.
                    </p>

                </div>

            </div>
            <!-- Back To Menu -->

            <button class="back-menu" id="backMenu" type="button">
                ← &nbsp; BACK TO MENU
            </button>
            <!-- Exit Confirmation Popup -->

            <div class="exit-popup" id="exitPopup">

                <div class="exit-popup-content">

                    <h3>EXIT GAME?</h3>

                    <p>
                        Are you sure you want to leave the game?
                    </p>

                    <p>
                        Your current score and game progress will be lost.
                    </p>

                    <div class="exit-buttons">

                        <button id="cancelExit" type="button">
                            CANCEL
                        </button>

                        <button id="confirmExit" type="button">
                            EXIT GAME
                        </button>

                    </div>

                </div>

            </div>
        </section>



        <!-- =========================
             GAME OVER
        ========================== -->

        <section class="game-card game-over" id="gameOver" style="display: none;">

            <div class="game-heading">

                <p class="small-title">
                    GAME OVER
                </p>

                <h1>
                    NICE TRY!
                </h1>

                <p class="description">
                    Here's how you did.
                </p>

            </div>


            <div class="final-results">

                <div class="final-stat">

                    <span>
                        FINAL SCORE
                    </span>

                    <strong id="finalScore">
                        0
                    </strong>

                </div>


                <div class="final-stat">

                    <span>
                        WORDS SOLVED
                    </span>

                    <strong id="finalWordsSolved">
                        0
                    </strong>

                </div>


                <div class="final-stat">

                    <span>
                        HIGHEST SCORE
                    </span>

                    <strong id="finalHighestScore">
                        0
                    </strong>

                </div>

            </div>


            <button class="back-menu" id="gameOverMenu" type="button">
                ← &nbsp; BACK TO MENU
            </button>

        </section>

    </main>



    <!-- Footer -->

    <footer class="footer">

        <p>
            ©
            <?php echo date("Y"); ?> WordGuess.
            Have fun!
        </p>

    </footer>



    <!-- JavaScript -->

    <script src="script.js"></script>

</body>

</html>