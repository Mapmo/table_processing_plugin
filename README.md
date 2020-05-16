# table_processing_plugin
Final project for the Web Technologies subject at FMI, Sofia University

Документация:

Импортване на `.xlsx` файлове (Таня + Мартин)

* /
	 * `index.php`
		* Почиства ако преди това е имало друга сесия (включително временните файлове)
		* Форма, в която могат да се качват файлове (1 или много) само с разширение `.xlsx` - Excel 2007+ файлове\]
		* При submit се праща POST HTTP заявка към файла `ParseFile.php`
	* `visual.php`
		* Тук потребителят идва след като е качил таблиците си
		* Използва се `includes/ParseTable.php` за обработка на качените файлове
		* Потребителят има падащо меню, което използвайки сесия, показва кои са наличните таблици
		* При submit се зарежда избраната таблица на база на $_GET от формата чрез `includes/PrintTable.php`
		* Използваме сесия, защото след всяко събмитване на формата се заличават променливите от предишния скрипт и така губехме имената на качените файлове
        * След като зареди файла, на потребителят ми се появява вече и форма за записване, в която избира някой от качените от него файлове и форматът на файла.
        При цъкане на бутона за записване, се изпраща заявка към  `download.php`, в който вече започва да стриймва искания файл от потребителя чрез `includes/streamfile.php`
* /includes

	* `includes/ParseFile.php`
		* Новокачените файлове се филтрират за празни имена и пътища
		* Създава се директорията `./uploads` (ако не съществува)
		* За всеки един файл:
			* преименуваме го, като за префикс слагаме микросекунди (Unix timestamp) конкатенирани с "-" и истинското име на файла 
				---> по този начин избягваме повторение на имена на качените от потребителя файлове
			* преместваме го в `./uploads` директорията
			* полезен ресурс за conteditable div: https://stackoverflow.com/questions/1391278/contenteditable-change-events
			* файлът се записва в сесията, като ключът е новото му име, а стойността му е старото
	* `includes/PrintTable.php`
		* Файлът се парсва и се репрезентира на страницата като таблица, чиито клетки могат да се редактират (conteditable div)

	* `./includes/SimpleXLSX.php`
		* Външна библиотека 
		* Използва се за парсване на `.xlsx` файла във формат на php асоциативен масив
    *  `./includes/streamfile.php`
        * Файлът се взима от файловата система на съръвра и се стриймва на части на клиента