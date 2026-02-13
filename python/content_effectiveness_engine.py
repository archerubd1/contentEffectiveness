import mysql.connector
import pickle
import pandas as pd

model = pickle.load(open("content_model.pkl","rb"))

db = mysql.connector.connect(
    host="localhost",
    user="db_user",
    password="db_password",
    database="astraal_lxp"
)

cursor = db.cursor(dictionary=True)

cursor.execute("SELECT * FROM content_signals")
rows = cursor.fetchall()

df = pd.DataFrame(rows)

X = df[['avg_time_spent','dropoff_rate',
        'early_assessment_score',
        'engagement_variance',
        'revisit_rate']]

probs = model.predict_proba(X)[:,1]

cursor.execute("DELETE FROM content_effectiveness_predictions")

for i,row in df.iterrows():

    risk = "Stable"
    if probs[i] < 0.7:
        risk = "Monitor"
    if probs[i] < 0.4:
        risk = "Needs Review"

    cursor.execute("""
    INSERT INTO content_effectiveness_predictions
    VALUES (%s,%s,%s,%s,NOW())
    """,(row['unit_id'],probs[i],risk,0.8))

db.commit()
db.close()
