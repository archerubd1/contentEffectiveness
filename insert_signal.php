<?php
require_once __DIR__ . '/includes/db.php';

$sql = "INSERT INTO content_signals
(unit_id, avg_time_spent, expected_time, dropoff_rate,
 early_assessment_score, engagement_variance,
 revisit_rate, sample_size, calculated_on)
VALUES
(:unit_id, :avg_time_spent, :expected_time, :dropoff_rate,
 :early_assessment_score, :engagement_variance,
 :revisit_rate, :sample_size, NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':unit_id' => 1,
    ':avg_time_spent' => 0.85,
    ':expected_time' => 600,
    ':dropoff_rate' => 0.30,
    ':early_assessment_score' => 78,
    ':engagement_variance' => 120,
    ':revisit_rate' => 0.25,
    ':sample_size' => 45
]);

echo "Signal inserted successfully!";
?>