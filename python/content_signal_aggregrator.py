import mysql.connector
import numpy as np

db = mysql.connector.connect(
    host="localhost",
    user="db_user",
    password="db_password",
    database="astraal_lxp"
)

cursor = db.cursor(dictionary=True)

cursor.execute("SELECT unit_id, estimated_time FROM content_units")
units = cursor.fetchall()

for unit in units:

    unit_id = unit['unit_id']
    expected_time = unit['estimated_time']

    cursor.execute("""
    SELECT time_spent, completion_status, assessment_score
    FROM learner_content_activity
    WHERE unit_id=%s
    """, (unit_id,))

    rows = cursor.fetchall()
    if len(rows) < 5:
        continue

    times = [r['time_spent'] for r in rows]
    avg_time = np.mean(times) / expected_time
    dropoff = sum(1 for r in rows if r['completion_status']==0) / len(rows)
    early_score = np.mean([r['assessment_score'] for r in rows])
    variance = np.std(times)
    revisit = sum(1 for r in rows if r['time_spent'] > expected_time) / len(rows)

    cursor.execute("""
    REPLACE INTO content_signals
    VALUES (%s,%s,%s,%s,%s,%s,%s,NOW())
    """, (unit_id, avg_time, dropoff, early_score, variance, revisit, len(rows)))

db.commit()
db.close()
