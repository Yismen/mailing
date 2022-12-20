 # Dainsys Mailing and Recipients
 A full stack package to add mailing functionality to Laravel applications. This package allows you to associate recipients (contacts) to your mailable files.

 ### Installation
 1. Require using composer: `composer require dainsys/mailing`.
 2. You can install all package assets by running `php artisan mailing:install` command.
    1. Another option is installing each asset individually:
       1. Publish the assets: `@php artisan vendor:publish --force --tag=mailing:assets`.  
          1. optionally, you add the following line to your `composer` file, under the `scripts` and `post-update-cmd` key, to publish the assets every time you update your composer dependencies: `@php artisan vendor:publish --tag=mailing:assets --force --ansi`.
    2. If you may want to customize the migrations before next step, first publish them: `@php artisan vendor:publish --force --tag=mailing:migrations`.
    3. Run the migrations: `php artisan migrate`.   
 3. Only super admin users are allowed to interact with the app. You can register them using any of the following options:
    1. Using the register method of your `AuthServiceProvider`: `\Dainsys\Mailing\Mailing::registerSuperUsers(["super@user1.com", "super@user2.com"]);`.
    2. In your `.env` file, `MAILING_SUPER_USERS='super@user1.com,super@user2.com'`
##### Configure your application
 1. Visit package main route: `/dainsys/mailing/about`.
 2. Optionally, you may want to publish and tweek the config file: `@php artisan vendor:publish --force --tag=mailing:config`.
 3. This package has its own views, designed with livewire and AdminLte. However, if you may want to change them then you can publish them with `@php artisan vendor:publish --force --tag=mailing:views`. 
 4. Package views extend it's own layout app. However, you can change this by adding the key `MAILING_LAYOUT_VIEW` to your `.env` file. Or, change it directly in the `mailing` config file, under the `layout` key.

#### Usage
1. The package is configured to auto discover your mailables within then `app\Mail` directory. However, if your mailables reside outside this folder or if you want to register another directory, add the line `\Dainsys\Mailing\Mailing::bind(app_path('Mail'));` to your `AppServiceProvider`. The package will try to load all your mailables for all directories added.
2. Visit route `/mailing/admin/recipients` to manage your recipients contacts.
3. Visit route `/mailing/admin/mailables` to manage your mailables and assign them to the recipients.
4. In your mailables, you can access the array of recipients associated to that class with the code snippet  `\Dainsys\Mailing\Mailing::recipients($this);`. For example, `->to(\Dainsys\Mailing\Mailing::recipients($this))`

