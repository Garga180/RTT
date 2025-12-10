#!/bin/bash

# Ha bármi hiba történik, álljon le a script (így látod a hibát, nem lép tovább)
set -e

echo "🚀 Indítási folyamat kezdése..."

# 1. JOGOSULTSÁGOK JAVÍTÁSA (Kritikus!)
# Ez oldja meg a "Permission denied" hibát a logoknál
echo "🔧 Jogosultságok beállítása..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# 2. .ENV FÁJL PÓTLÁSA (Ha nincs)
if [ ! -f ".env" ]; then
    echo "⚠️ .env nem található, másolás az example-ből..."
    cp .env.example .env
fi

# 3. COMPOSER FÜGGŐSÉGEK
# Ha a volume felülírta a vendort, ez pótolja
if [ ! -d "vendor" ]; then
    echo "📦 Vendor mappa hiányzik, telepítés..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# 4. KULCS GENERÁLÁS (JAVÍTOTT SORREND!)
# Csak akkor generálunk, ha még nincs beállítva a .env-ben
if grep -q "APP_KEY=" .env && [ -z "$(grep "APP_KEY=" .env | cut -d '=' -f 2)" ]; then
    echo "🔑 Új APP_KEY generálása..."
    php artisan key:generate
    php artisan config:clear
fi

# 5. VÁRAKOZÁS AZ ADATBÁZISRA
./wait-for-it.sh mysql:3306 --timeout=60 --strict -- echo "✅ MySQL elérhető!"

# 6. ADATBÁZIS MŰVELETEK
echo "🗄️ Migráció futtatása..."
php artisan migrate --force
php artisan db:seed --force

# 7. TÁROLÓ LINKELÉSE ÉS CACHE TÖRLÉS
php artisan storage:link || true
php artisan config:clear
php artisan cache:clear

echo "🏁 Minden kész! Apache indítása..."
exec apache2-foreground