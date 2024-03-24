# Webhooks Service

![](https://preview.dragon-code.pro/laravel-lang/webhooks-service.svg?brand=laravel)

> Service for quickly publishing information about new releases in Telegram chats.

## Available Routes

| Method | URL               | Required Events       | Description                                                                                                       |
|--------|-------------------|-----------------------|-------------------------------------------------------------------------------------------------------------------|
| `POST` | `/api/assign`     | Pull Requests, Issues | Identifies by PR title the team members responsible for its review                                                |
| `POST` | `/api/dependabot` | Pull Requests         | Sends a comment to PR from Dependabot for acceptance after successfully passing the tests                         |
| `POST` | `/api/merge`      | Pull Requests         | Automatic approval and acceptance of PRs that meet certain conditions                                             |
| `POST` | `/api/release`    | Releases              | Calls the mechanism for publishing information about the release on social networks of the "Laravel-Lang" project |
| `POST` | `/api/repository` | Repositories          | Webhook responsible for the initial setup of the repository                                                       |

To display a list of all routes, run the console command:

```Bash
php artisan route:list
```

## Contributing

Please see [CONTRIBUTING](https://laravel-lang.com/contributions.html) for details.

## License

This package is licensed under the [MIT License](https://laravel-lang.com/license.html).
