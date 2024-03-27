# Webhooks Service

![](https://preview.dragon-code.pro/laravel-lang/webhooks-service.svg?brand=laravel)

> Service for quickly publishing information about new releases in Telegram chats.

## Available Routes

| Method | URL                             | Required Events       | Description                                                                                                       |
|--------|---------------------------------|-----------------------|-------------------------------------------------------------------------------------------------------------------|
| `POST` | `/api/pull-requests/assign`     | Pull Requests, Issues | Identifies by PR title the team members responsible for its review                                                |
| `POST` | `/api/pull-requests/dependabot` | Pull Requests         | Sends a comment to PR from Dependabot for acceptance after successfully passing the tests                         |
| `POST` | `/api/pull-requests/merge`      | Pull Requests         | Automatic approval and acceptance of PRs that meet certain conditions                                             |
| `POST` | `/api/releases/publish`         | Releases              | Calls the mechanism for publishing information about the release on social networks of the "Laravel-Lang" project |
| `POST` | `/api/repositories/create`      | Repositories          | Webhook responsible for the initial setup of the repository                                                       |

To display a list of all routes, run the console command:

```Bash
php artisan route:list
```

## Telegram Commands

To connect a regular channel or group, just add the bot to the group with administrator rights.

If your group is divided into forums, then in the forum topic you need to send the command `/connect` to the chat so
that the bot can bind to the topic.

## Contributing

Please see [CONTRIBUTING](https://laravel-lang.com/contributions.html) for details.

## License

This package is licensed under the [MIT License](https://laravel-lang.com/license.html).
