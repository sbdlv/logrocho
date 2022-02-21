# Consultar la nota total calculada de los pinchos
```sql
SELECT p.id, (SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 as "Nota total" FROM `pincho` p JOIN review r ON p.id = r.pincho_id GROUP BY p.id; 
```

# Consultar la nota total calculada de los pinchos de un bar en especifico
```sql
SELECT p.id, b.id, (SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/ 3 as "Total" FROM `pincho` p JOIN review r ON p.id = r.pincho_id JOIN bar b ON b.id = p.bar_id WHERE b.id = 4 GROUP BY p.id;
```

# Puntuación de un bar
```sql
SELECT b.id, b.name, b.address, b.lon, b.lat, b.terrace, ((SUM(r.presentation) + SUM(r.taste) + SUM(r.texture))/3/COUNT(r.id)) AS rating FROM `bar` b LEFT JOIN pincho p ON b.id = p.bar_id LEFT JOIN review as r ON r.pincho_id = p.id GROUP BY b.id; 
```

