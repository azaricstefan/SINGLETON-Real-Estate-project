<H2>PODESAVANJE PROJEKTA - NOVO</H2>
<p>Prethodno je potrebno instalirati:</p>
<ul>

    <li><a href="http://www.wampserver.com/en/">PHP(Preko WAMP-a)</a> ili <a href="http://php.net/downloads.php">standalone(5.4+)</a></li>
    <li><a href="https://getcomposer.org/download/">Composer(Composer-Setup.exe)</a></li>
    <li><a href=https://www.jetbrains.com/student/>JetBrains PhpStorm</a></li>
    <li><a href=https://git-scm.com/download/win/>Git For Windows</a></li>
</ul>

<ol>
    <li>Otici u folder u koji zelimo da smestimo projekat i klonirati repozitorijum:<br>
    <img src="http://i.imgur.com/rCds3Pe.png" width=600/><br/><br>
    <img src="http://i.imgur.com/UZjLnF6.png" width=600/></li><br>
    <li> Pokrenuti PhpStorm i napraviti projekat koristeci vec postojece fajlove <br>
    <img src="http://i.imgur.com/DaAkK44.png" width=600/><br/><br>
    <li> Postaviti klonirani repozitorijum kao "Project Root" i kliknuti "Finish" <br>
    <img src="http://i.imgur.com/QuAr9Pe.png" width=600/><br/><br>
     <li>U Okruzenju otvoriti terminal <code>ALT+F12</code> ili  <strong>View->Tool Windows->Terminal</strong> i pokrenuti komandu:<pre>composer update</pre>
    <img src="http://i.imgur.com/60sX7cc.png" width=600/><br/><br>
    <li> Sacekati neko vreme. Medju direktorijumima bi trebalo da se pojavi direktrojium <code>vendor</code><br>
    <img src="http://i.imgur.com/616X5P6.png" width=600/><br/><br>
   <li> Kreirati <code>.env</code> fajl kopiranjem <code>.env.example</code> fajla komandom <br/> <pre>copy .env.example .env
</pre><br>
    <img src="http://i.imgur.com/6bUfgI1.png" width=600/><br/><br>
    <li>U podesavanjima projekta <strong>File -> Settings ->Tools-> Command Line Tool Support </strong> dodati novu komandnu liniju. Potrebno je da je izabrana opcija <code>Tool based on Symphony Console</code><br>
    <img src="http://i.imgur.com/UFrB8S4.png" width=600/><br/><br>
    <li>Popuniti ostale parametre i kliknuti na OK<br>
    <img src="http://i.imgur.com/C6OcMu8.png" width=600/><br/><br>
     <li>Zatvoriti <strong>Settings</strong> klikom na Ok i otvoriti komandni prozor <code>CTRL-SHIFT-X</code> ili <strong>Tools->Run Command</strong><br>
    <img src="http://i.imgur.com/QQq1Y3d.png" width=600/><br/><br>
     <li>Pokrenuti sledece komande u komandnom prozoru:<br>
     <pre>artisan key:generate</pre>
     <pre>artisan clear-compiled</pre>
     <pre>artisan ide-helper:generate </pre>
     <pre>artisan optimize</pre>
    <img src="http://i.imgur.com/Yk07sQk.png" width=600/><br/><br>
   <li>Sacekati da se komande zavrse a zatim pokrenuti komandu:<br>
   <pre>artisan serve</pre>
   Upaliti browser i otici na localhost:8000. Ukoliko stranica izgleda kao na slici okruzenje je podeseno.
    <img src="http://i.imgur.com/xmaTd71.png" width=600/><br/><br>
</ol>

</ol>

<h2>PREĆI SLEDEĆI KLIP ZA PODEŠAVANJE OKRUŽENJA</h2>
<a href="https://www.youtube.com/watch?v=QSZK1W0fbGQ" target="_blank">Podešavanje okruženja -> youtube</a> <br>
Ovde imate tekstualno objašnjeno delovi sa klipa: <a href="https://confluence.jetbrains.com/display/PhpStorm/Laravel+Development+using+PhpStorm#LaravelDevelopmentusingPhpStorm-LaravelFrameworkSupportinPhpStorm" target="_blank">Podešavanje okruženja -> tekstualno</a> <br>
<a href="https://laravelcollective.com/docs/5.2/html" target="_blank">Laravel Collective</a> <br>
<a href="https://github.com/laracasts/Laravel-5-Generators-Extended" target="_blank">Laravel 5 Generators Extended</a> <br>
<a href="https://github.com/appzcoder/crud-generator" target="_blank">Laravel CRUD generator</a> <br>
<a href="https://github.com/barryvdh/laravel-ide-helper" target="_blank">Laravel IDE helper</a> <br>
<a href="https://github.com/koomai/phpstorm-laravel-live-templates" target="_blank">PhpStorm Laravel Live templates</a>
<strong><p>Upoznati se sa funkcionisanje laravel framework-a do 27-og Aprila.</p><strong>
<p>Stefan: dodao sam dependency(zavisnosti) za LaravelCollective(forme), za Jezike(imamo SR i EN)</p>
<u><p>Odgledati takođe i klipove na dropbox-u "Laravel from scratch"</p><u>
<p>Kome nije nešto jasno nek se javi na chat što pre, da bi se to razjasnilo.</p>
<p>.env fajl tu podesiti bazu parametre<p>
<u>Also, note that Laravel 5.1 and 5.2 requires PHP >= 5.5.9 whereas for PHP 5.0, you only need PHP >= 5.4.</u> <br>
------------------------------------------------------------------------------------------------------
<p>Mihailo: Ispratiti tutorial i uraditi sve iz prvog videa "Podesavanje okruzenja"</p>
<p>Napraviti novi folder negde na disku koji ce sluziti kao root projekta i ujedno i kao lokalni repozitorijum</p>
<p>Pulovati sa githuba u taj folder, prekopirati .idea folder iz projekta u kome je podesavano okruzenje u taj folder</p>
<p>U PHPStormu otvoriti ovaj novi projekat preko File->Open, okruzenje je podeseno :)</p>
------------------------------------------------------------------------------------------------------

