## Zrealizowane funkcjonalności

1. **System rejestracji i logowania użytkowników**
    - Użyto wbudowanego pakietu Laravel Breeze.
    - Dostęp do zadań mają tylko zalogowani użytkownicy.

2. **CRUD zadań**
    - Tworzenie, edycja, usuwanie i przeglądanie zadań.
    - Walidacja danych z użyciem dedykowanych Requestów.

3. **Filtrowanie i sortowanie zadań**
    - Możliwość filtrowania zadań po statusie, priorytecie, dacie.
    - Sortowanie zadań według terminu realizacji.

4. **Generowanie publicznego linku do zadania**
    - Link zawiera token, ważny przez 60 minut.
    - Zadanie można udostępnić bez logowania.

5. **Historia edycji zadania**
    - Każda zmiana zapisywana jest w osobnej tabeli `task_histories`.
    - Możliwość przeglądania poprzednich wersji zadań.

6. **Responsywny interfejs użytkownika**
    - Prosty layout oparty na czystym CSS.
    - Formularze, przyciski, listy i widoki wystylizowane z dbałością o spójność.

7. **Konteneryzacja aplikacji**
    - Docker + Docker Compose.
    - Konfiguracja dla PHP 8.3, MySQL 8.0, NGINX, Node.js.
    - Pliki: `docker-compose.yml`, `Dockerfile`, `nginx/default.conf`.

---

## Przemyślenia i uwagi

Rozważałem użycie TailwindCSS, jednak technologia ta nie została wskazana w specyfikacji projektu, dlatego postawiłem na czysty CSS. W większych projektach Tailwind byłby zdecydowanie moim wyborem, ponieważ znacząco przyspiesza pracę nad UI.

Jeśli chodzi o strukturę backendu – zauważyłem pewien dysonans między zasadami SOLID a podejściem opartym na Eloquent ORM. Modele w Laravelu bezpośrednio łączą logikę biznesową z bazą danych, co w większych systemach prowadzi do mieszania warstw. Osobiście preferuję wzorzec Repository, który pozwala na rozdzielenie odpowiedzialności i lepsze testowanie, jednak ze względu na skalę projektu uznałem, że jego implementacja byłaby przesadą.

Chciałbym także zaznaczyć, że posiadam 5 lat doświadczenia zawodowego jako backend/fullstack developer, głównie w pracy z Magento 2 oraz Symfony. Moim największym wyzwaniem w tym projekcie była początkowa nieznajomość aktualnego Laravela – ostatni raz pracowałem z tym frameworkiem około 4,5 roku temu. Mimo to, uważam, że szybko odświeżyłem wiedzę i poradziłem sobie ze wszystkimi wymaganiami.

Uwzględniając to wszystko, czuję, że moja wiedza i doświadczenie wykraczają poza poziom Juniora, i mam nadzieję, że zostanie to dostrzeżone i docenione.

---

Dziękuję za możliwość realizacji tego zadania – było ciekawym wyzwaniem i świetną okazją do ponownego kontaktu z Laravelem.
