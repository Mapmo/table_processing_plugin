Final project for the Web Technologies subject at FMI, Sofia University

Документация:

Импортване на .xlsx файлове (Таня + Мартин); Експортване на .xlsx файлове - Даниел

Важно: добави "max_input_vars=100000" в php.ini, може да го модифицираш според броя на клетките в таблицата

* /
    * /index.php
        * Ако клиентът не е логнат го кара или да се регистрира или да влезе в акаунта си.
        * Логнат потребител вижда форма, в която могат да се качват файлове (1 или много) само с разширение .xlsx - Excel 2007+ файлове]
        * При submit се праща POST HTTP заявка към файла visual.php

    * /login.php
	* Позволява на потребителя да въведе потребителско име и парола
	* Пренасочва към includes/login.php, където се извършва валидация и същинско логване в системата
	* Използва /includes/captcha.php за създаване на captcha image

    * /register.php
	* Позволява на потребителя да се регистрира в системата
	* Пренасочва към includes/register.php, където се извършва същинкста регистрация или евентуален провал
	* Използва /includes/captcha.php за създаване на captcha image
	
    * /visual.php
        * Тук потребителят идва след като е качил таблиците си
        * Използва се includes/parse_table.php за обработка на качените файлове
        * Потребителят има падащо меню, което използвайки сесия, показва кои са наличните таблици
        * При submit се зарежда избраната таблица(като форма) на база на $_GET от формата чрез includes/print_table.php, като ако вече е заредил някоя таблица, то промените в нея ще бъдат запазени, като се изпрати заявка към update_table.php и всяка клетка е мапната към ключ(id) с формат ред|колона.
        * Използваме сесия, защото след всяко събмитване на формата се заличават променливите от предишния скрипт и така губехме имената на качените файлове
	    * Потребителят има възможност и да търси под формата на regex за дадена стойност из таблицата
        * Потребителят може и след избиране на клетка да промени форматирането и, т.е. да я "разкраси" - в болднат, курсив и/или подчертан стил.
        * След като зареди файла - таблицата, на потребителя му се появява вече и форма за записване, в която избира някой от качените от него файлове и форматът на файла. 
        * При цъкане на бутона за записване, се изпраща заявка към streamfile.php, в който вече започва да стриймва искания файл.

* /includes
   * /includes/captcha.php
	* Създава captcha image и сетва $_SESSION['captcha'] с въпросната стойност
	* Изисква php-gd блиблотеката!!!, която след инсталация трябва да се добави и в php.ini (extension=gd)
	* Използва различни шрифтове от /includes/fonts
 
   * /includes/css
   	* /includes/beautify.css
            * Съдържа стиловете, които се използват за форматиране на клетките - болднат, курсив и подчертан.
	* /includes/main.css
	    * Съдържа основните стилове, които са използвани из целия проект

   * /includes/db_connection.php
	* Създава връзка с базата данни
	* конфигурирана е за mysql с user: root и pass: 1234
    	* използваме PDO (ресурс за затварянето на връзката с базата: https://stackoverflow.com/questions/18277233/pdo-closing-connection), изисква да се добави extension=php_pdo_mysql в php.ini файла


   * /includes/fonts
	* Директория, съдържаща много шрифотве
	* Използват се за /includes/captcha.php	

   * /includes/js
	* /includes/js/update.js
	    * Съдържа функцията check(), която служи за цъкане на скрития бутон за update във формата с таблицата

	* includes/js/beautify.js
	    * Съдържа функции, свързани с прилагането на форматиране на клетките на таблицата (toggleBoldStyle, etc.) и updateRowAndCol функцията, която ъпдейтва избраната клетка (чрез скритите input полета с id-та rowToBeautify и colToBeautify от visual.php)

    * /includes/login.php
	* Извършва валидация за влизане в системата
	* Извиква се от /login.php 

   * /includes/logout.php
	* Унищожава сесията и пренасочва към index.php

    * /includes/parse_file.php
        * Новокачените файлове се филтрират за празни имена и пътища
        * Създава се директорията ./uploads (ако не съществува)
        * За всеки един файл:
            * преименуваме го, като за префикс слагаме микросекунди (Unix timestamp) конкатенирани с "-" и истинското име на файла ---> по този начин избягваме повторение на имена на качените от потребителя файлове
            * преместваме го в ./uploads директорията
            * файлът се записва в сесията, като ключът е новото му име, а стойността му е старото

    * /includes/print_table.php
        * Файлът се парсва и се репрезентира на страницата като таблица, чиито клетки могат да се редактират
	    * В зависимост дали става дума за търсене или за обикновено показване, файлът използва един от двата файла за показване на редовете от таблицата
		    - includes/print_row_search.php
		    - includes/print_row_nosearch.php

    * /includes/register.php
	* Използва се за регистриране в системата
	* Извиква се /register.php
	* Валидира капчата и повторената парола
	* Създава home directory за потребителя с номера на неговото id в базата данни

    * /includes/SimpleXLSX.php
        * Външна библиотека
        * Използва се за парсване на .xlsx файла във формат на php асоциативен масив

    * /includes/print_row_nosearch.php 
	* Извежда ред по ред стойностите на таблицата

    * /includes/print_row_search
	* Обхожда таблицата ред по ред и принтира само тези, които отговарят на regex стойността от $_POST['search']

    * /includes/update_table.php
        * Получава заявка със съдържанието на всички клетки от таблицата и името на таблицата
        * Ъпдейтва файла с новото съдържание

    * /includes/utils
	* Съдържа основни функции, за манипулиране на данни

/users - съхранява файловете на потребителите
	* 0 - default user, използва се като skel при създаването на нови потребители
	    * shared.yml - използва се за съхранение на файловете, които са споделени с потребителя

* /configs
	* /configs/database.ini - Съдържа необходимите конфигурациите за свързване с базата
	* /configs/hash.ini - Съдържа конфигурации свързами с хеширането на важни потребителски данни
	* /configs/exporting.ini - Съдържа конфигурации свързани с експортване на таблици - списъкл от съпортнати extensions, размер на блоковете, които се пращат на потребителите при операцията по теглене

DATABASE SETUP:
user: root
password: 1234
name: tables_db
tables: 
	- users:
		id: int AI
		user: varchar 256
		password: varchar 256
