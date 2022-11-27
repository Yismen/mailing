 # Dainsys Report
 A full stack package to add report functionality to Laravel applications. 

 ### Installation
 1. Require using composer: `composer require dainsys/report`.
 2. Publish the assets: `@php artisan vendor:publish --force --tag=report:assets`.  
    1. optionally, you add the following line to your `composer` file, under the `scripts` and `post-update-cmd` key, to publish the assets every time you update your composer dependencies: `@php artisan vendor:publish --tag=report:assets --force --ansi`.
 3. Run the migrations: `php artisan migrate`.
    1. If you may want to customize the migrations before this step, first publish them: `@php artisan vendor:publish --force --tag=report:migrations`.
 4. Optionally, you may want to publish and tweek the config file: `@php artisan vendor:publish --force --tag=report:config`.
 5. This package has its own views, designed with livewire and CoreUi. However, if you may want to change them then you can publish them with `@php artisan vendor:publish --force --tag=report:views`. 
 6. Package views extend it's own layout app. However, you can change this by adding the key `INVOICE_LAYOUT_VIEW` to your `.env` file. Or, change it directly in the `report` config file, under the `layout` key.
##### Configure your application
1. Visit route `/dainsys/report/forms` and create a Form: A form is a report frame which will contain many questions. Set the date and time until when a form would be receiving answers or leave it empty if you it should allways be open. If you set a date and time, users will not be able to save responses passed time.
2. Visit route `/dainsys/report/options` and create Question Option: Options is what the user will select when responding a question. 
3. Visit route `/dainsys/report/question` and create Questions: Questions are of a type and belongs to a form.
4. Users will be responding suerveys from a create endpoint `/dainsys/report/entries/create`
5. Visit package main route: `/dainsys/report/about`.
 
 #### Ussage
 1. People can fillout reports by visiting route `/dainsys/report/fill/{form-slug}`.
    1. If you do not want to accept responses for a particular form, just dissable the acdepting answers option for the form.
 2. If you want to fully seed your database in development, we sugges the following seeder:
```javascript
if (!app()->isProduction()) {
   $this->option_ids = \Dainsys\Report\Models\Option::pluck('id')->all();
   $this->option_types_ids = \Dainsys\Report\Models\OptionType::pluck('id')->all();

   \Dainsys\Report\Models\Form::factory(15)->create()
         ->each(function ($form) {
            \Dainsys\Report\Models\Entry::factory(rand(1, 15))->create(['form_id' => $form->id])
               ->each(function ($entry) use ($form) {
                     $question = \Dainsys\Report\Models\Question::factory()->create([
                        'form_id' => $form->id, 
                        'option_type_id' => Arr::random($this->option_types_ids)
                     ]);
                     \Dainsys\Report\Models\Response::factory()->create([
                        'entry_id' => $entry->id, 
                        'question_id' => $question->id, 
                        'option_id' => Arr::random($this->option_ids)
                     ]);
               });
         });
}
  ```
##### Api
 1. adfasfad
