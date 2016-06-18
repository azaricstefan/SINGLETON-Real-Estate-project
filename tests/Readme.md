<H2>Kako podesiti testing bazu</H2>
<ol>
  <li>Pulovati najnoviju verziju projekta(master)</li> 
  <li>Napraviti novu mysql bazu koristeci <a href="https://github.com/xlstefan/SINGLETON-Real-Estate-project/blob/master/Faze/Faza%204%20-%20Modelovanje%20baze%20podataka/real_estate_db_test_schema.sql">real_estate_db_test_schema.sql</a>
  <li>u .env fajl dodati promenljive koje opisuje konekciju za kreiranu bazu
    <img src="http://image.prntscr.com/image/8ce9a41d7cf149a0aaa60415ed113b9b.png"></img>
    Trebalo bi da promenite samo username i password i eventualno host/port ukoliko je to potrebno
  </li>
  <li>Ukoliko pokrecete PHPUNIT iz PhpStorm okruzenja ne zaboravite da ukljucite phpunit.xml konfiguraciju kao default konfiguraciju okruzenja za phpunit
    <img src="http://image.prntscr.com/image/97a5e4c63f3c4e12bf08c5e002a58b36.png"/>
  </li>
</ol>
