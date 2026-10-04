<?php

header("Content-Type: application/json");

require_once "database.php";

try {

    $sql = "SELECT id, word, definition, difficulty
            FROM words
            ORDER BY RAND()
            LIMIT 1";

    $stmt = $pdo->query($sql);

    $word = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($word) {
        echo json_encode([
            "success" => true,
            "word" => $word["word"],
            "definition" => $word["definition"],
            "difficulty" => $word["difficulty"]
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No words found in the database."
        ]);
    }

} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}