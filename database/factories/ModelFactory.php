<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Author;

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'email' => preg_replace('/@example\..*/', '@getcraftable.com', $faker->unique()->safeEmail),
        'password'=> $password ?: $password = bcrypt('secret'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'activated' => true,
        'forbidden' => false,
        'language' => 'en',

        'title' => $faker->firstName . ' ' . $faker->lastName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});

$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,

    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Author::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->firstName . ' ' . $faker->lastName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    if (Author::count() > 0) {
        $author = Author::inRandomOrder()->first();
    }

    return [
        'title' => $faker->sentence,
        'perex' => $faker->text(),
        'published_at' => $faker->date(),
        'enabled' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'author_id' => isset($author) ? $author->id : null,

    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\TranslatableArticle::class, function (Faker\Generator $faker) {
    return [
        'published_at' => $faker->date(),
        'enabled' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,

        'title' => [
            'en' => $faker->sentence,
            'de' => $faker->sentence,
            'fr' => $faker->sentence,
        ],
        'perex' => [
            'en' => $faker->text(),
            'de' => $faker->text(),
            'fr' => $faker->text(),
        ],

    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Export::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'perex' => $faker->text(),
        'published_at' => $faker->date(),
        'enabled' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ArticlesWithRelationship::class, function (Faker\Generator $faker) {
    if (Author::count() > 0) {
        $author = Author::inRandomOrder()->first();
    }

    return [
        'title' => $faker->sentence,
        'perex' => $faker->text(),
        'published_at' => $faker->date(),
        'enabled' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'author_id' => isset($author) ? $author->id : null,


    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\BulkAction::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'perex' => $faker->text(),
        'published_at' => $faker->date(),
        'enabled' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    if (\Brackets\AdminAuth\Models\AdminUser::count() > 0) {
        $author = \Brackets\AdminAuth\Models\AdminUser::inRandomOrder()->first();
    }

    return [
        'title' => $faker->sentence,
        'perex' => $faker->text(),
        'published_at' => $faker->date(),
        'enabled' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'updated_by_admin_user_id' => isset($author) ? $author->id : 1,

    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Indicadore::class, function (Faker\Generator $faker) {
    return [
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Indicadore::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->sentence,
        'categoria' => $faker->sentence,
        'tipo' => $faker->boolean(),
        'direccion_api' => $faker->sentence,
        'nombre_archivo' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        'datos_indicador' => ['en' => $faker->sentence],
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\CategoriaIndicadore::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->sentence,
        'codigo' => $faker->sentence,
        'archivo_muestra' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

