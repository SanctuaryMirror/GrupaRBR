# Task Manager - Laravel 11 + Docker

## Instrukcja uruchomienia

1. Sklonuj repozytorium:
```bash
git clone https://github.com/SanctuaryMirror/GrupaRBR.git
cd GrupaRBR
cd laravel
```

2. Skopiuj plik środowiskowy i wygeneruj klucz aplikacji:
```bash
cp .env.example .env
php artisan key:generate
```
3. Edytuj .env i upewnij się, że masz ustawione:
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```
4. Uruchom kontenery:
```bash
docker-compose up -d --build
```
5. Wejdź do kontenera aplikacji:
```bash
docker exec -it laravel-app bash
```
6. Zainstaluj zależności PHP:
```bash
composer install
```
7. Zainstaluj zależności Node.js:
```bash
npm install
```
8. Zbuduj frontend:
```bash
npm run build
```
9. Wykonaj migracje i seedy:
```bash
php artisan migrate --seed
```

Kolejki:
W pliku .env ustaw driver kolejki (na czas developmentu możesz użyć synchronizacji, która działa bez kolejek):
```bash
QUEUE_CONNECTION=sync
```
Jeśli chcesz używać kolejek asynchronicznie (np. database), wykonaj migrację tabeli kolejek:
```bash
php artisan queue:table
php artisan migrate
```
Uruchom worker kolejek (w osobnym terminalu lub jako proces systemowy):
```bash
php artisan queue:work
```

Scheduler:
W app/Console/Kernel.php jest skonfigurowane zadanie harmonogramu (scheduler), które należy wywoływać cyklicznie.

Na produkcji dodaj do crontaba wpis uruchamiający scheduler co minutę:
```bash
* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1
```
Lokalnie możesz wywołać scheduler ręcznie:
```bash
php artisan schedule:run
```

Konfiguracja mailera
W .env ustaw dane do SMTP, np. z Mailtrap:
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=twoj_login
MAIL_PASSWORD=twoje_haslo
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="${APP_NAME}"
```
Dostęp do aplikacji:
```bash
http://localhost:8080
```

Dane testowego użytkownika 1:

Email:
```bash 
test@test.test
```
Hasło:
```bash
test123
```

Dane testowego użytkownika 2:

Email:
```bash 
test@test.com
```
Hasło:
```bash
test123
```