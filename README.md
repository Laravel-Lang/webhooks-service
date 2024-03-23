# Webhooks Service

![](https://preview.dragon-code.pro/laravel-lang/webhooks-service.svg?brand=laravel)

> Service for quickly publishing information about new releases in Telegram chats.

## Available Routes

| Method | URL                | Description                                                                                                       |
|--------|--------------------|-------------------------------------------------------------------------------------------------------------------|
| `POST` | `/api/assign`      | Identifies by PR title the team members responsible for its review                                                |
| `POST` | `/api/dependabot`  | Sends a comment to PR from Dependabot for acceptance after successfully passing the tests                         |
| `POST` | `/api/release`     | Calls the mechanism for publishing information about the release on social networks of the "Laravel-Lang" project |
| `POST` | `/api/translation` | Automatically approves and accepts PR with machine translation                                                    |

To display a list of all routes, run the console command:

```Bash
php artisan route:list
```


## Contributing

Please see [CONTRIBUTING](https://laravel-lang.com/contributions.html) for details.

## License

This package is licensed under the [MIT License](https://laravel-lang.com/license.html).
