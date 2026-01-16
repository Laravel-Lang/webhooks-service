# Webhooks Service

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://banners.beyondco.de/Webhooks%20Service.png?pattern=topography&style=style_2&fontSize=100px&md=1&showWatermark=1&icon=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg&theme=dark&packageManager=composer+require&packageName=laravel%2Flaravel&description=by+Laravel+Lang&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg">
    <img src="https://banners.beyondco.de/Webhooks%20Service.png?pattern=topography&style=style_2&fontSize=100px&md=1&showWatermark=1&icon=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg&theme=light&packageManager=composer+require&packageName=laravel%2Flaravel&description=by+Laravel+Lang&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Webhooks Service">
</picture>

![](https://banners.beyondco.de/Webhook%20Service.png?theme=light&packageManager=&packageName=&pattern=topography&style=style_2&description=by+Laravel+Lang&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

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

> Note
> 
> When publishing messages in topics that are closed from users, you must grant the bot rights to manage topics.

## Contributing

Please see [CONTRIBUTING](https://laravel-lang.com/contributions.html) for details.

## Support Us

❤️ Laravel Lang? Please consider supporting our collective on [Boosty](https://boosty.to/laravel-lang).

## License

This package is licensed under the [MIT License](https://laravel-lang.com/license.html).
