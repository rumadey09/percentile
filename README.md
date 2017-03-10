# Percentile Rank - Calculation Program
Scope: Student data is considered in comma-separated format where the columns are ID, name, and GPA. The program output will contain Id, student name, GPA and calculated percentile rank

Run site in local server - http://localhost/percentile/
                                                                 
Created by: Ruma Dey, 2017                                           

## Contents:
- Cakephp 3.4 requirements
- PHP Version 5.6.0 and above
- Installation
- List of Important Files and Functions
	
## Cakephp 3.4 requirements
- PHP >= 5.6.0
In XAMPP, intl extension is included but you have to uncomment extension=php_intl.dll in php.ini and restart the server through the XAMPP Control Panel.
In WAMP, the intl extension is �activated� by default but not working. To make it work you have to go to php folder (by default) C:\wamp\bin\php\php{version}, copy all the files that looks like icu*.dll and paste them into the apache bin directory C:\wamp\bin\apache\apache{version}\bin. Then restart all services and it should be OK.
- Composer

## Installation
- Composer should be installed.
- Open command prompt in project directory and run command.
- php composer create-project --prefer-dist cakephp/app percentile
- To run phpunit, Run command  vendor/bin/phpunit from project directory.
 
## List of Important Files and Functions

### src/
This folder contains Controller, Model and View used to write functions to read data from csv and calculate percentile.

### controller
controller is present in src/Controller/PercentileController.php, It calls percentile controller functions and render result to views.
controller is present in src/Controller/AppController.php, Common functions are written in it.


### model
model is present in src/Model/Entity/Percentile.php, It calls percentile entity model functions and its used for convert array format and upload the files.


### component
Percentile Component is present in src/Controller/Component/PercentileComponent.php, Its calculate Percentile Rank.

### Views
view is present in src/Template/Percentile/index.ctp. It is used to render results.

### Routes
Routes file is present in config/routes.php. It is used to navigate url to appropriate operation logic.

### Unit tests
Php unit test file is present in tests/TestCase/Controller/PercentileControllerTest.php  <br>
tests/TestCase/Controller/Component/CalculationComponent.php <br>
Test particular student's GPA percentile rank - testStudentsPercentile method in tests/TestCase/Controller/Component/CalculationComponent.php <br>
Test all the students percentile rank - testIndex method in tests/TestCase/Controller/PercentileControllerTest.php <br>
To run phpunit, Run command 'vendor/bin/phpunit' from project directory.