Final project for the Web Technologies subject at FMI, Sofia University

Документация:

Импортване на .xlsx файлове (Таня + Мартин); Експортване на .xlsx файлове - Даниел

Важно: добави "max_input_vars=100000" в php.ini, може да го модифицираш според броя на клетките в таблицата

* /
    * /index.php
        * Ако клиентът не е логнат го кара или да се регистрира или да влезе в акаунта си.
        * Логнат потребител вижда форма, в която могат да се качват файлове (1 или много) само с разширение .xlsx - Excel 2007+ файлове]
        * При submit се праща POST HTTP към /includes/parse_file.php и след това бива върнат отново тук
	* Ако потребителят има качени/споделени файлове в системата, той може да ги редактира чрез натискане на бутона Edit
	* Всеки файл е под формата на форма, за да може да се предаде чрез $_POST['table'] на visual.php коя таблица да отвори

    * /login_form.php
	* Позволява на потребителя да въведе потребителско име и парола
	* Пренасочва към includes/login.php, където се извършва валидация и същинско логване в системата
	* Използва /includes/captcha.php за създаване на captcha image

    * /register_form.php
	* Позволява на потребителя да се регистрира в системата
	* Пренасочва към includes/register.php, където се извършва същинската регистрация или евентуален провал
	* Използва /includes/captcha.php за създаване на captcha image
	
    * /visual.php
        * Тук потребителят вижда визуализация на таблицата
	* Потребителят може да се върне в главното меню или да излезе от системата
	* Потребителят има възможност да търси под формата на regex за дадена стойност из таблицата
	* Ако потребителят има права за редактиране, той може да:
		* Променя данните в клетките
        	* Потребителят може и след избиране на клетка да промени форматирането и, т.е. да я "разкраси" - в болднат, курсив и/или подчертан стил.
        * При цъкане на бутона за записване, се изпраща заявка към streamfile.php, в който вече започва да стриймва искания файл.
	* Самата таблица всъщност е форма с метод пост
	* Всички линкове за излизане от страницата или този за търсене са форми, които извикват js функция, която клика върху скрия submit бутон на горната форма и така презаписва таблицата

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
		* извиква се и функцията updateBeautifier(), което ъпдейтва всички приложени от потребителя стилове в съответните json файлове в директорията users/{user_id}/beautifiers

	* includes/js/beautify.js
	    * Съдържа функции, свързани с прилагането на форматиране на клетките на таблицата (toggleBoldStyle, etc.) и updateRowAndCol функцията, която ъпдейтва избраната клетка (чрез скритите input полета с id-та rowToBeautify и colToBeautify от visual.php)

    * /includes/login.php
	* Извършва валидация за влизане в системата
	* Извиква се от /login_form.php 
	* Сетва $_SESSION['user'] = $_POST['user']

   * /includes/logout.php
	* Унищожава сесията и пренасочва към index.php

    * /includes/parse_file.php
	* Потребителите се водят от /index.php тук, когато качват файлове
        * Новокачените файлове се филтрират за празни имена и пътища
        * Създава се директорията ./users/USERNAME/uploads (ако не съществува)
        * За всеки един файл:
            * преместваме го в /users/uploads директорията, като ако вече има такъв файл там го преименуваме с индексче
	    * добавя мета данните му в shared_files.yaml файла на потребителя
	* Връща потребителя в /index.php след като файловете са качени

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

* /users - съхранява файловете на потребителите
	* 0 - default user, използва се като skel при създаването на нови потребители
	    * shared_files.yml - използва се за съхранение на файловете, които са споделени с потребителя. Има 3 параметъра:
		- name: име на файла
		- owner: собственик на файла
		- write: 0/1 (0 - само четене, 1 - редакция)
	* /{user_id}/beautifiers 
		- пази информация за приложените стилове (bold, italic и underline) върху таблиците на потребителя с идентификатор user_id
		- съдържа файлове в json формат
		- всеки json е наименован със съответното име на таблицата (това в /uploads)
			
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

