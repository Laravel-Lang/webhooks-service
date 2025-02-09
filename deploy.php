<?php

declare(strict_types=1);

namespace Deployer;

require 'contrib/php-fpm.php';
require 'contrib/telegram.php';
require 'recipe/laravel.php';

// Config

set('application', 'Laravel-Lang: Webhooks');
set('repository', 'git@github.com:Laravel-Lang/webhooks-service.git');
set('php_fpm_version', '8.4');

set('telegram_token', $_SERVER['TELEGRAM_DRAGON_BOT_TOKEN']);
set('telegram_chat_id', $_SERVER['TELEGRAM_DRAGON_BOT_CHAT_ID']);

$title = '*{{application}}*' . PHP_EOL . PHP_EOL;

set('telegram_text', $title . 'Deploying `{{branch}}` to *{{target}}*');
set('telegram_success_text', $title . 'Deployed some fresh code to *{{target}}*');
set('telegram_failure_text', $title . 'Something went wrong during deployment to *{{target}}*');

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
    'artisan:operations:before',
    'deploy:publish',
    'php-fpm:reload',
    'artisan:queue:restart',
    'artisan:operations',
]);

task('artisan:operations', function () {
    cd('{{release_path}}');
    run('{{bin/php}} artisan operations');
});

task('artisan:operations:before', function () {
    cd('{{release_path}}');
    run('{{bin/php}} artisan operations --before');
});

before('deploy', 'telegram:notify');

after('deploy:success', 'telegram:notify:success');

after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'telegram:notify:failure');
