<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['city' => 'Madrid',      'country' => 'España',                  'continent' => 'Europa',           'weather_type' => 'Mediterráneo', 'description' => 'Capital de España, ciudad vibrante con una rica historia, arte y gastronomía. Hogar del Museo del Prado, el Parque del Retiro y una inigualable vida nocturna.'],
            ['city' => 'París',       'country' => 'Francia',                 'continent' => 'Europa',           'weather_type' => 'Templado',     'description' => 'La Ciudad de la Luz deslumbra con la Torre Eiffel, el Louvre y sus icónicos cafés. Un destino romántico por excelencia con una cultura culinaria única.'],
            ['city' => 'Tokio',       'country' => 'Japón',                   'continent' => 'Asia',             'weather_type' => 'Templado',     'description' => 'Metrópolis futurista que fusiona tradición y modernidad. Desde templos milenarios hasta barrios neón, Tokio es una experiencia única e inigualable.'],
            ['city' => 'Nueva York',  'country' => 'Estados Unidos',          'continent' => 'América del Norte','weather_type' => 'Variable',     'description' => 'La Gran Manzana nunca duerme. Times Square, Central Park, la Estatua de la Libertad y los mejores museos del mundo te esperan en esta ciudad sin igual.'],
            ['city' => 'Dubái',       'country' => 'Emiratos Árabes Unidos',  'continent' => 'Asia',             'weather_type' => 'Desértico',    'description' => 'Ciudad del lujo y la innovación en el desierto. El Burj Khalifa, islas artificiales y enormes centros comerciales convierten Dubái en un destino sin límites.'],
            ['city' => 'Bali',        'country' => 'Indonesia',               'continent' => 'Asia',             'weather_type' => 'Tropical',     'description' => 'Isla de los Dioses, Bali combina playas paradisíacas, templos hindús y arrozales en terrazas. Un santuario de paz y naturaleza en el sureste asiático.'],
            ['city' => 'Barcelona',   'country' => 'España',                  'continent' => 'Europa',           'weather_type' => 'Mediterráneo', 'description' => 'Ciudad condal de arquitectura única con Gaudí como protagonista. La Sagrada Família, Las Ramblas y sus playas la convierten en uno de los destinos favoritos de Europa.'],
            ['city' => 'Cancún',      'country' => 'México',                  'continent' => 'América del Norte','weather_type' => 'Tropical',     'description' => 'Paraíso caribeño con aguas turquesas y arenas blancas. Las ruinas mayas, los cenotes y la vibrante Zona Hotelera hacen de Cancún el destino tropical perfecto.'],
            ['city' => 'Londres',     'country' => 'Reino Unido',             'continent' => 'Europa',           'weather_type' => 'Lluvioso',     'description' => 'Capital multicultural con siglos de historia. El Tower Bridge, Buckingham Palace, el West End y una escena gastronómica de primer nivel hacen de Londres un destino imprescindible.'],
            ['city' => 'Sídney',      'country' => 'Australia',               'continent' => 'Oceanía',          'weather_type' => 'Soleado',      'description' => 'La ciudad más grande de Australia sorprende con la Ópera de Sídney, el Harbour Bridge, Bondi Beach y un entorno natural de extraordinaria belleza.'],
        ];

        foreach ($locations as $data) {
            Location::create(array_merge($data, ['image_url' => null, 'status' => true]));
        }
    }
}
