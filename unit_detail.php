<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require_once __DIR__ . '/includes/db.php';

$unit_id = $_GET['unit_id'];

$stmt = $pdo->prepare("SELECT * FROM content_signals WHERE unit_id = ?");
$stmt->execute([$unit_id]);
$signal = $stmt->fetch();

$stmt2 = $pdo->prepare("SELECT * FROM content_effectiveness_predictions WHERE unit_id = ? ORDER BY calculated_on DESC LIMIT 1");
$stmt2->execute([$unit_id]);
$prediction = $stmt2->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unit Detail</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Unit <?= $unit_id ?> Detail</h2>

        <h3>Raw Signals</h3>
        <ul>
            <li>Avg Time Ratio: <?= $signal['avg_time_spent']; ?></li>
            <li>Dropoff Rate: <?= $signal['dropoff_rate']; ?></li>
            <li>Assessment Score: <?= $signal['early_assessment_score']; ?></li>
            <li>Engagement Variance: <?= $signal['engagement_variance']; ?></li>
            <li>Revisit Rate: <?= $signal['revisit_rate']; ?></li>
            <li>Sample Size: <?= $signal['sample_size']; ?></li>
        </ul>

        <h3>Prediction</h3>
        <ul>
            <li>Effectiveness: <?= round($prediction['predicted_effectiveness'] * 100); ?>%</li>
            <li>Risk Level: <?= $prediction['risk_level']; ?></li>
            <li>Confidence: <?= round($prediction['confidence_score'] * 100); ?>%</li>
        </ul>

        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>