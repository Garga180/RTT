## Dockerbe imagekent letrehozni

docker-compose up -d --build

## Csatlakozni az adatbazishoz

docker exec -it mysql-db mysql -u root -p

SHOW DATABASES;       -- Adatbázisok listázása
USE adatbazis_neve;   -- Belépés egy adatbázisba
SHOW TABLES;          -- Táblák listázása
SELECT * FROM tabla;  -- Adatok lekérése

