# assignment

This project was created to follow the assignment tasks

Envirement variables:
- php 8
- composer
- symfony CLI

To setup project run the following commands:
- composer install
- php bin/console d:d:c
- php bin/console d:s:c

This project has a goal to let the user upload files containing users to be inserted in the database.
My approche was to create upload form and save the file in project directory while creating a message bus async to be treated lately by anyone with access to console.

To consume messages in queue you have to run the following command:  `php bin/console messenger:consume async`

Folder under /src to mention:
- Factory: Contaning implementation to launch a number of the workers if needed (only one in this case)
- Command: Contaning the definition of Symfony command that takes --file as argument (exp: php bin/console app:user --file=challenge.json)
- Message: Containes ProcessNotification to be created async
- MessageHandler: Contains ProcessNotificationHandler and its sole job is to launch inserting users process
- Helpers: With class Decode to allow the decoding of both type files json and xml into an array of users 
