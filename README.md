# Pixel XML Form

Uses XML file as a definition for the form that will produce the result using user input and formula defined in the same XML file.

Project uses [Yii2 Framework](https://www.yiiframework.com/).

## Requirements

- PHP installed
- Database access
- Composer installed ([Composer website](https://getcomposer.org/))

## Installation

1) Download or clone this repository.

2) Enter the project's folder

3) Install dependencies using a command
 
```bash
composer install
```

4) In the project folder change database access parameters in file

```bash
config/db.php
```
_The possible issue can be using localhost instead of 127.0.0.1 and reverse_

5) Populate the database using the command

```bash
php yii migrate
```

6) Run the application using the command

```bash
php yii serve --port=8888
```

7) Visit page in browser
```bash
http://localhost:8888
```

## Usage

The XML file for the form definition is located file

```bash
data/form-definition.xml
```
Parameters defined in that file will be used to show form fields and to validate input.

## Tests

Run test using command

```bash
./vendor/bin/codecept run
```
