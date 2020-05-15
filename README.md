# table_processing_plugin
Final project for the Web Technologies subject at FMI, Sofia University

Документация:

Импортване на `.xlsx` файлове (Таня)

	* Front end - `index.html`		
		* Форма, в която могат да се качват файлове само с разширение `.xlsx` - Excel 2007+ файлове
		* При submit се праща POST HTTP заявка към файла `ParseFile.php`
	* Back end
		* `ParseFile.php`
			* `include "./includes/SimpleXLSX.php";` ---> ползва се за парсване на `.xlsx` файла във формат на php асоциативен масив
			* новокаченият файл се преименува до `temp.xlsx` и се мести в директорията `./uploads`
			* парсва файла и го репрезентира на страницата като таблица, чиито клетки могат да се редактират (conteditable div)
			* полезен ресурс за conteditable div: https://stackoverflow.com/questions/1391278/contenteditable-change-events