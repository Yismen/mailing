 # Dainsys Report
 A full stack package to add report functionality to Laravel applications. 

 ### Installation
 1. Require using composer: `composer require dainsys/report`.
 2. Publish the assets: `@php artisan vendor:publish --force --tag=report:assets`.  
    1. optionally, you add the following line to your `composer` file, under the `scripts` and `post-update-cmd` key, to publish the assets every time you update your composer dependencies: `@php artisan vendor:publish --tag=report:assets --force --ansi`.
    2. If you may want to customize the migrations before next step, first publish them: `@php artisan vendor:publish --force --tag=report:migrations`.
 3. Run the migrations: `php artisan migrate`.   
##### Configure your application
 1. Visit package main route: `/dainsys/report/about`.
 2. Optionally, you may want to publish and tweek the config file: `@php artisan vendor:publish --force --tag=report:config`.
 3. This package has its own views, designed with livewire and AdminLte. However, if you may want to change them then you can publish them with `@php artisan vendor:publish --force --tag=report:views`. 
 4. Package views extend it's own layout app. However, you can change this by adding the key `REPORT_LAYOUT_VIEW` to your `.env` file. Or, change it directly in the `report` config file, under the `layout` key.

#### Usage
1. The package is configured to auto discover your mailables within then `app\Mail` directory. However, if your mailables reside outside this folder or if you want to register another directory, add the line `\Dainsys\Report\Report::bind(app_path('Mail'));` to your `AppServiceProvider`. The package will try to load all your mailables for all directories added.
2. Visit route `/report/admin/recipients` to manage your recipients contacts.
3. Visit route `/report/admin/mailables` to manage your mailables and assign them to the recipients.
4. In your mailables, you can access the array of recipients associated to that class with the code snippet  `\Dainsys\Report\Report::recipients($this);`. For example, `->to(\Dainsys\Report\Report::recipients($this))`

