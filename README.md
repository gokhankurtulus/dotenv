# dotenv

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)
![Release](https://img.shields.io/github/v/release/gokhankurtulus/dotenv.svg)

A simple library to supply environment variables from `.env`.

## Installation

You can install the Dotenv using [Composer](https://getcomposer.org/). Run the following command in your project's root directory:

```bash
composer require gokhankurtulus/dotenv
```

## Usage

Example `.env` file;

```dotenv
EXAMPLE_KEY=mykey
EXAMPLE_SECRET=mysecret
DB_DRIVER=mysql
DB_TABLE=tablename
```

To use the Dotenv class in your PHP script, you need to include the Composer autoloader:

```php
require_once 'vendor/autoload.php';
```

Example PHP file;

```php
use Dotenv\Dotenv;

$dotenv = new Dotenv('.env');
// This will cause an \Exception because VERSION is not set on the environment file and raiseError is true by default.
$dotenv->required(['VERSION']); 

// If you don't want to get exception you can pass false as second parameter
if (!$dotenv->required(['VERSION'], false));
    echo 'You have to set VERSION.';
echo $_ENV['EXAMPLE_KEY']; // Output: mykey
```

## Securing the .env File

The `.env` file contains sensitive information such as database credentials, API keys, and other confidential data. It is important to secure the file and restrict access to prevent unauthorized
exposure of this information. Here are some guidelines to consider:

1. File Placement: Place the `.env` file outside the public web directory or in a directory that is not directly accessible by the web server. This prevents direct access to the file via URL.

2. File Permissions: Set appropriate file permissions to ensure that only authorized users or processes can read the `.env` file. Restricting access to the file prevents unauthorized users from
   viewing its contents.

3. Gitignore: Add the `.env` file to your project's `.gitignore` file. This ensures that the file is not included in version control systems, preventing accidental exposure of sensitive information in
   your code repository.

4. Environment-specific Files: Consider using separate `.env` files for different environments (e.g., development, staging, production). This allows you to specify environment-specific configurations
   and reduces the risk of exposing sensitive credentials in non-production environments.

5. Encryption or Encoding: If required, you can encrypt or encode sensitive values within the `.env` file. This adds an extra layer of protection, and the values can be decrypted or decoded at runtime
   when they are needed.

Remember, the security of your application depends on properly safeguarding the sensitive information stored in the `.env` file. Regularly review and update the file, and ensure that access to it is
limited to authorized individuals or processes.

**Note:** It is important to consult with a security professional and follow security best practices to ensure the confidentiality and integrity of your application's sensitive data.

## License

Dotenv is open-source software released under the [MIT License](LICENSE). Feel free to modify and use it in your projects.

## Contributions

Contributions to Dotenv are welcome! If you find any issues or have suggestions for improvements, please create an issue or submit a pull request on
the [GitHub repository](https://github.com/gokhankurtulus/dotenv).