<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'role_id' => 1,
		'designation_id' => $faker->numberBetween(1, 10),
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
		'status' => 'active',
	];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->jobTitle,
		'description' => $faker->text(40),
		'status' => 'active',
	];
});

$factory->define(App\Designation::class, function (Faker\Generator $faker) {
	return [
		'title' => $faker->unique()->jobTitle,
		'sequence' => $faker->randomDigitNotNull,
		'short_name' => $faker->text(10),
		'status' => 'active',
	];
});

$factory->define(App\Shop::class, function (Faker\Generator $faker) {
	return [
		'division_id' => 1,
		'district_id' => 2,
		'thana_id' => 3,
		'region_id' => 7,
		'area_id' => null,
		'depot_id' => 1,
		'category' => $faker->randomElement(array('A', 'B', 'C')),
		'outlet_name' => $faker->domainWord,
		'proprietor_name' => $faker->name,
		'nid' => $faker->year . $faker->numberBetween(1000000000000, 9999999999999),
		'trade_license' => null,
		'mobile' => '017' . $faker->numberBetween(10000000, 99999999),
		'is_distributor' => 1,
		'distributor_id' => null,
		'created_at' => $faker->dateTime('now'),
		'updated_at' => $faker->dateTime('now'),
	];
});

$factory->define(App\SiteSetting::class, function (Faker\Generator $faker) {
	$filepath = storage_path('app/public');
	return [
		'site_title' => 'Dhaka Ice-Creame Ltd.',
		'site_author' => $faker->name,
		'author_email' => $faker->unique()->safeEmail,
		//'logo' => $faker->image($filepath, '150', '150', null, false),
		'logo' => 'logo.png',
	];
});

$factory->define(App\DamageType::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
	];
});
