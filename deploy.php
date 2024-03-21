<?php

declare(strict_types=1);

namespace Deployer;

require 'contrib/php-fpm.php';
require 'contrib/telegram.php';
require 'recipe/laravel.php';

// Config

set('application', 'Laravel-Lang: Webhooks');
set('repository', 'git@github.com:Laravel-Lang/release-publisher.git');
set('php_fpm_version', '8.2');

set('telegram_token', $_SERVER['TELEGRAM_DRAGON_BOT_TOKEN']);
set('telegram_chat_id', $_SERVER['TELEGRAM_DRAGON_BOT_CHAT_ID']);

set('telegram_text', 'Deploying `{{branch}}` to *{{target}}*' . PHP_EOL . PHP_EOL . '*Application*: {{application}}');
set('telegram_success_text', 'Deployed some fresh code to *{{target}}*' . PHP_EOL . PHP_EOL . '*Application*: {{application}}');
set('telegram_failure_text', 'Something went wrong during deployment to *{{target}}*' . PHP_EOL . PHP_EOL . '*Application*: {{application}}');

// Hosts

host('production')
    ->setHostname($_SERVER['DEPLOY_IP'])
    ->setRemoteUser('forge')
    ->setDeployPath('~/domains/' . $_SERVER['DEPLOY_HOST']);

// Tasks

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:optimize:clear',
    'artisan:optimize',
    'artisan:migrate',
    'deploy:publish',
    'php-fpm:reload',
]);

before('deploy', 'telegram:notify');

after('deploy:success', 'telegram:notify:success');

after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'telegram:notify:failure');
