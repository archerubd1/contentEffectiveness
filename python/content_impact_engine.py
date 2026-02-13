import mysql.connector

db = mysql.connector.connect(
    host="localhost",
    user="db_user",
    password="db_password",
    database="astraal_lxp"
)

cursor = db.cursor(dictionary=True)

cursor.execute("""
SELECT unit_id, predicted_effectiveness
FROM content_effectiveness_predictions
WHERE risk_level='Needs Review'
""")

units = cursor.fetchall()

for unit in units:

    risk = 1 - unit['predicted_effectiveness']

    cursor.execute("""
    SELECT to_node, weight
    FROM kg_edges
    WHERE from_node=%s AND relationship_type='BUILDS'
    """,(unit['unit_id'],))

    skills = cursor.fetchall()

    for skill in skills:

        cursor.execute("""
        SELECT from_node, weight
        FROM kg_edges
        WHERE to_node=%s AND relationship_type='REQUIRES'
        """,(skill['to_node'],))

        roles = cursor.fetchall()

        for role in roles:

            impact = risk * skill['weight'] * role['weight']

            cursor.execute("""
            INSERT INTO content_skill_impact
            VALUES (%s,%s,%s,%s,NOW())
            """,(unit['unit_id'],
                 skill['to_node'],
                 role['from_node'],
                 impact))

db.commit()
db.close()
