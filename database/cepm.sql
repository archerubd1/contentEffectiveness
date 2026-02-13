CREATE TABLE content_signals (
  unit_id INT,
  avg_time_spent FLOAT,
  dropoff_rate FLOAT,
  early_assessment_score FLOAT,
  engagement_variance FLOAT,
  revisit_rate FLOAT,
  sample_size INT,
  calculated_on DATETIME
);

CREATE TABLE content_effectiveness_predictions (
  unit_id INT,
  predicted_effectiveness FLOAT,
  risk_level VARCHAR(50),
  confidence_score FLOAT,
  calculated_on DATETIME
);

CREATE TABLE content_skill_impact (
  unit_id INT,
  skill_node INT,
  career_node INT,
  structural_impact FLOAT,
  calculated_on DATETIME
);

CREATE TABLE content_revision_log (
  unit_id INT,
  action_taken TEXT,
  revised_by INT,
  timestamp DATETIME
);
