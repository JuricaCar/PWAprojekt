Po�tovani kolege,

Kako bi projekt radio potrebno je pokrenuti stranicu index.php koristeci XAMPP.

Da to otvorite potrebno je izvr�iti sljedece korake

      1. Poslanu mapu otpakirati i staviti u htdocs folder u xamppu

      2. U browseru u adresnu traku upisati localhost/phpmyadmin te kliknuti na gumb import i odabrati "news.sql" koji je u otpakiranom folderu.

      3. U browseru u adresnu traku upisati localhost/PWA_projekt

      4. Pritisnuti index.php stranicu ili u navedenu adresu dodati index.php (localhost/PWA_projekt/index.php)


Opis

Folder images sadr�i slike koje su kori�tene na stranicama.

Folder Zadatak sadr�i projektni zadatak koji sam dobio odnosno izgled clanka i izgled pocetne stranice

index.php pokazuje 3 clanka iz dvije kategorije (Sport i Politika) te ima navigaciju gdje se mo�e doci do drugih stranica

unos.html sadr�i formu gdje korisnik mo�e izraditi svoj clanak te kada klikne gumb posalji ode na stranicu unos.php koja pokazuje
izgled tog clanka, taj clanak se sada mo�e vidjeti na stranici kategorija.php odnosno u navigaciji je potrebno izabrati kategoriju
koju ste dodjelili clanku.

registracija.php je stranica na koju se dode pomocu navigacije klikom na "REGISTRACIJA". Ta stranica sadr�i formu za registraciju
te izradu racuna, cijela forma je validarana JavaScriptom te ako je korisnicko ime zauzeto onda nam forma javlja poruku.

administracija.php je stranica na koju se potrebno ulogirati s korisnickim racunom, ako je razina u bazi podataka za
korisnika 0 onda nemamo pristup stranici. Vrijednost razine je default 0, a mo�e se jedino promjeniti u samoj bazi podataka.
Ako korisnik ima razinu 1 onda dobiva pristup stranici gdje mo�e uredivati svaki clanak te ih isto mo�e i obrisati.





Jurica Car