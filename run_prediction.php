<?php
require_once __DIR__ . '/includes/db.php';

/*
Simple CEPM Risk Logic (temporary before ML)

Effectiveness Score =
Average of:
- avg_time_spent
- (1 - dropoff_rate)
- (early_assessment_score / 100)
- revisit_rate

*/

$query = "SELECT * FROM content_signals";
$stmt = $pdo->query($query);
$signals = $stmt->fetchAll();

foreach ($signals as $row) {

    $time_score = $row['avg_time_spent'];
    $completion_score = 1 - $row['dropoff_rate'];
    $assessment_score = $row['early_assessment_score'] / 100;
    $revisit_score = $row['revisit_rate'];

    $predicted_effectiveness = (
        $time_score +
        $completion_score +
        $assessment_score +
        $revisit_score
    ) / 4;

    $risk_score = 1 - $predicted_effectiveness;

    if ($risk_score > 0.6) {
        $risk_level = "Needs Review";
    } elseif ($risk_score > 0.3) {
        $risk_level = "Monitor";
    } else {
        $risk_level = "Stable";
    }

    $confidence = min(1, $row['sample_size'] / 100);

    $insert = "INSERT INTO content_effectiveness_predictions
    (unit_id, predicted_effectiveness, risk_level, confidence_score, calculated_on)
    VALUES (:unit_id, :predicted_effectiveness, :risk_level, :confidence_score, NOW())";

    $stmtInsert = $pdo->prepare($insert);

    $stmtInsert->execute([
        ':unit_id' => $row['unit_id'],
        ':predicted_effectiveness' => $predicted_effectiveness,
        ':risk_level' => $risk_level,
        ':confidence_score' => $confidence
    ]);
}

echo "Predictions generated successfully!";
?>