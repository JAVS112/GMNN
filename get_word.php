<?php

header("Content-Type: application/json");

require_once "database.php";

try {

    $difficulty = $_GET["difficulty"] ?? "";

    $previous = $_GET["previous"] ?? "";

    $sql = "SELECT id, word, definition, hint, difficulty
            FROM words
            WHERE difficulty = :difficulty
            AND word != :previous
            ORDER BY RAND()
            LIMIT 1";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":difficulty" => $difficulty,
        ":previous" => $previous
    ]);

    $word = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($word) {

        echo json_encode([
            "success" => true,
            "word" => $word["word"],
            "definition" => $word["definition"],
            "hint" => $word["hint"],
            "difficulty" => $word["difficulty"]
        ]);

    } else {

        echo json_encode([
            "success" => false,
            "message" => "No words found for this difficulty."
        ]);

    }

} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);

}