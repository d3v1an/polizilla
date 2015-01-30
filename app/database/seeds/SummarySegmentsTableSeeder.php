<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SummarySegmentsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Segment::create(['board_id'=>3,'name'=>'Principal']);
		Segment::create(['board_id'=>3,'name'=>'Estados']);
		Segment::create(['board_id'=>3,'name'=>'Subsecretarias']);
		Segment::create(['board_id'=>3,'name'=>'Primeras Planas']);
		Segment::create(['board_id'=>3,'name'=>'Temas varios']);
		Segment::create(['board_id'=>3,'name'=>'Columnas Politicas']);
		Segment::create(['board_id'=>3,'name'=>'Cartones']);
		Segment::create(['board_id'=>51,'name'=>'Notas Principales EPN']);
		Segment::create(['board_id'=>51,'name'=>'Pemex en medios nacionales']);
		Segment::create(['board_id'=>51,'name'=>'En los estados']);
		Segment::create(['board_id'=>51,'name'=>'Primeras Planas']);
		Segment::create(['board_id'=>51,'name'=>'Columnas Politicas']);
		Segment::create(['board_id'=>51,'name'=>'Columnas Financieras']);
		Segment::create(['board_id'=>51,'name'=>'Cartones']);
	}

}