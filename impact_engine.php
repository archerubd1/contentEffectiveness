<?php
require_once __DIR__ . '/includes/db.php';

$stmt = $pdo->query("SELECT * FROM content_effectiveness_predictions WHERE risk_level = 'Needs Review'");
$units = $stmt->fetchAll();

foreach ($units as $unit) {

    $unit_id = $unit['unit_id'];
    $risk_score = 1 - $unit['predicted_effectiveness'];

    $skillStmt = $pdo->prepare("SELECT * FROM kg_edges WHERE from_node = ? AND relationship_type = 'BUILDS'");
    $skillStmt->execute([$unit_id]);
    $skills = $skillStmt->fetchAll();

    foreach ($skills as $skill) {

        $skill_id = $skill['to_node'];
        $skill_weight = $skill['weight'];

        $careerStmt = $pdo->prepare("SELECT * FROM kg_edges WHERE from_node = ? AND relationship_type = 'REQUIRES'");
        $careerStmt->execute([$skill_id]);
        $careers = $careerStmt->fetchAll();

        foreach ($careers as $career) {

            $impact = $risk_score * $skill_weight * $career['weight'];

            $insert = $pdo->prepare("INSERT INTO content_skill_impact
                (unit_id, skill_node, career_node, structural_impact, calculated_on)
                VALUES (?, ?, ?, ?, NOW())");

            $insert->execute([$unit_id, $skill_id, $career['to_node'], $impact]);
        }
    }
}

echo "Impact analysis complete.";
?>