## Dockerbe imagekent letrehozni

docker-compose up -d --build

## teljesen leallitani a futo appot

docker-compose down -v

## Csatlakozni az adatbazishoz

docker exec -it laravelwebshop_mysql mysql -u root -p

SHOW DATABASES;       -- Adatbázisok listázása
USE adatbazis_neve;   -- Belépés egy adatbázisba
SHOW TABLES;          -- Táblák listázása
SELECT * FROM tabla;  -- Adatok lekérése

