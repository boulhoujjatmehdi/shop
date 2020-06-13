    <?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $words = ['Women','Men','Kids','Accesories'];
    
    return [
        'name'=>$faker->word(),
        'domain_name'=>$faker->randomElement($words),
        ];
});
