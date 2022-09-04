## Getting Started

This is how you can set up this project locally. To get a local copy up and running follow these simple example steps.

### Installation

1. Clone the repo
    ```sh
    git clone
    ```
2. Install all the packages of new application
    ```sh
    composer install
    ```
3. Create the env file
    ```sh
    cp .env.example .env
    ```
4. Generate a key
    ```
    php artisan key:generate
    ```
5. Modify the env file with your database credentials
    ```
    DB_DATABASE = example_db_name
    DB_USERNAME = example_user
    DB_PASSWORD = example_password
    ```
6. Modify the env file with your SMTP credentials (_MailTrap recommended_)
    ```
    MAIL_MAILER = smtp
    MAIL_HOST = example_host
    MAIL_PORT = example_port
    MAIL_USERNAME = example_username
    MAIL_PASSWORD = example_password
    MAIL_ENCRYPTION = example_encryption
    MAIL_FROM_ADDRESS = "no-reply@brainsterpreneurs.com"
    MAIL_FROM_NAME = "${APP_NAME}"
    ```

7. Create the tables in the database

    ```
    php artisan migrate
    ```

8. Fill the tables with the data

    ```
    php artisan db:seed
    ```

9. Install package manager for the JavaScript

    ```
    npm install & npm run dev
    ```

10. Serve the project

    ```
    php artisan serve
    ```

    or if there is some other project running at port 8000

    ```
    php artisan serve --port=8001
    ```

11. Access the project at http://localhost:8000/ or the custom port that you set up
