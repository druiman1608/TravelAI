<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            [
                'location_id'     => 1,
                'name'            => 'Hotel Real Palacio',
                'description'     => 'Lujoso hotel de cinco estrellas situado en el corazón de Madrid, a pasos del Palacio Real y el Teatro Real. Sus elegantes habitaciones combinan la arquitectura clásica española con las últimas comodidades. Disfruta de nuestra piscina en la azotea con vistas panorámicas a la ciudad, el spa de clase mundial y nuestra propuesta gastronómica de autor.',
                'address'         => 'Calle Mayor 28, Centro',
                'zip_code'        => '28013',
                'stars'           => 5,
                'services'        => ['WiFi gratuito', 'Piscina exterior', 'Spa & Wellness', 'Restaurante gourmet', 'Bar en azotea', 'Gimnasio', 'Servicio de habitaciones 24h', 'Aparcamiento privado'],
                'available_rooms' => 80,
                'price_per_night' => 220.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel1/H1P1.jpg', 'ImagesProduccion/Hotels/Hotel1/H1P2.jpg', 'ImagesProduccion/Hotels/Hotel1/H1P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno incluido' => 20, 'Media pensión' => 45, 'Todo incluido' => 80],
            ],
            [
                'location_id'     => 2,
                'name'            => 'Maison Lumière',
                'description'     => 'Boutique hotel de cuatro estrellas en el elegante barrio de Le Marais, a cinco minutos del Centro Pompidou y del Sena. Sus habitaciones de diseño evocan el París clásico con toques contemporáneos. El desayuno continental en el jardín interior es una experiencia que no querrás perderte.',
                'address'         => 'Rue de Bretagne 45, Le Marais',
                'zip_code'        => '75003',
                'stars'           => 4,
                'services'        => ['WiFi gratuito', 'Jardín interior', 'Desayuno continental', 'Bar lounge', 'Conserjería 24h', 'Lavandería', 'Alquiler de bicicletas'],
                'available_rooms' => 42,
                'price_per_night' => 170.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel2/H2P1.jpg', 'ImagesProduccion/Hotels/Hotel2/H2P2.jpg', 'ImagesProduccion/Hotels/Hotel2/H2P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno incluido' => 18, 'Media pensión' => 40],
            ],
            [
                'location_id'     => 3,
                'name'            => 'Sakura Grand Hotel',
                'description'     => 'Hotel de cinco estrellas en Shinjuku, epicentro de la cultura moderna tokyota. Sus habitaciones de estilo japonés contemporáneo ofrecen vistas al monte Fuji los días despejados. El restaurante de kaiseki, el onsen en la planta 40 y el jardín zen hacen de este hotel una experiencia única e irrepetible.',
                'address'         => 'Shinjuku 3-chome 2-1, Shinjuku-ku',
                'zip_code'        => '160-0022',
                'stars'           => 5,
                'services'        => ['WiFi gratuito', 'Onsen (baño termal)', 'Jardín zen', 'Restaurante kaiseki', 'Bar panorámico', 'Gimnasio', 'Servicio de habitaciones 24h', 'Transfer aeropuerto'],
                'available_rooms' => 120,
                'price_per_night' => 280.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel3/H3P1.jpg', 'ImagesProduccion/Hotels/Hotel3/H3P2.jpg', 'ImagesProduccion/Hotels/Hotel3/H3P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno japonés' => 25, 'Media pensión' => 55, 'Experiencia kaiseki' => 90],
            ],
            [
                'location_id'     => 4,
                'name'            => 'Manhattan Sky Hotel',
                'description'     => 'Hotel de cuatro estrellas en Midtown Manhattan con vistas directas al Empire State Building. Ubicado a dos bloques del Rockefeller Center y a diez minutos de Times Square. Las habitaciones superiores ofrecen espectaculares panorámicas del skyline neoyorquino, especialmente impresionantes al atardecer.',
                'address'         => '5th Avenue 350, Midtown',
                'zip_code'        => '10001',
                'stars'           => 4,
                'services'        => ['WiFi gratuito', 'Piscina cubierta', 'Gimnasio', 'Restaurante', 'Bar Sky Lounge', 'Business center', 'Servicio de habitaciones', 'Concierge'],
                'available_rooms' => 200,
                'price_per_night' => 260.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel4/H4P1.jpg', 'ImagesProduccion/Hotels/Hotel4/H4P2.jpg', 'ImagesProduccion/Hotels/Hotel4/H4P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno americano' => 22, 'Media pensión' => 50],
            ],
            [
                'location_id'     => 5,
                'name'            => 'Desert Pearl Resort',
                'description'     => 'Icónico resort de cinco estrellas frente al mar en la Palm Jumeirah. Con su arquitectura inspirada en las perlas del Golfo y sus piscinas privadas, Desert Pearl Resort define el lujo en Dubái. La playa privada, los restaurantes de alta cocina y el spa premiado internacionalmente son solo algunos de sus atractivos.',
                'address'         => 'Palm Jumeirah, Crescent Road',
                'zip_code'        => '00000',
                'stars'           => 5,
                'services'        => ['WiFi gratuito', 'Playa privada', '3 piscinas exteriores', 'Spa de lujo', '4 restaurantes', 'Bar sky', 'Butler service', 'Gimnasio premium', 'Centro de buceo', 'Kids club'],
                'available_rooms' => 300,
                'price_per_night' => 350.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel5/H5P1.jpg', 'ImagesProduccion/Hotels/Hotel5/H5P2.jpg', 'ImagesProduccion/Hotels/Hotel5/H5P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno incluido' => 30, 'Media pensión' => 65, 'Todo incluido' => 120],
            ],
            [
                'location_id'     => 6,
                'name'            => 'Tropical Haven Bali',
                'description'     => 'Resort de cuatro estrellas entre los arrozales y la jungla de Ubud. Villas privadas con piscina infinita rodeadas de naturaleza tropical. El resort ofrece clases de yoga al amanecer, tratamientos de spa ayurvédico, talleres de cocina balinesa y excursiones a los templos sagrados de la zona.',
                'address'         => 'Jalan Raya Ubud, Gianyar',
                'zip_code'        => '80571',
                'stars'           => 4,
                'services'        => ['WiFi gratuito', 'Piscina infinita privada', 'Clases de yoga', 'Spa ayurvédico', 'Restaurante balinés', 'Excursiones culturales', 'Transfer aeropuerto', 'Bicicletas gratuitas'],
                'available_rooms' => 45,
                'price_per_night' => 130.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel6/H6P1.jpg', 'ImagesProduccion/Hotels/Hotel6/H6P2.jpg', 'ImagesProduccion/Hotels/Hotel6/H6P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno balinés' => 15, 'Media pensión' => 35, 'Todo incluido' => 65],
            ],
            [
                'location_id'     => 7,
                'name'            => 'Mediterráneo Grand',
                'description'     => 'Hotel de cuatro estrellas en el Paseo de Gràcia, la arteria más elegante de Barcelona. A tres minutos a pie de la Casa Batlló y la Pedrera de Gaudí. La terraza con piscina ofrece vistas únicas al Eixample. El restaurante propone una cocina mediterránea de autor con productos de mercado.',
                'address'         => 'Passeig de Gràcia 112, Eixample',
                'zip_code'        => '08008',
                'stars'           => 4,
                'services'        => ['WiFi gratuito', 'Piscina en terraza', 'Restaurante mediterráneo', 'Bar de vinos', 'Gimnasio', 'Spa', 'Servicio de habitaciones', 'Bicicletas gratuitas'],
                'available_rooms' => 95,
                'price_per_night' => 145.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel7/H7P1.jpg', 'ImagesProduccion/Hotels/Hotel7/H7P2.jpg', 'ImagesProduccion/Hotels/Hotel7/H7P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno incluido' => 16, 'Media pensión' => 38],
            ],
            [
                'location_id'     => 8,
                'name'            => 'Paradise Beach Resort',
                'description'     => 'Resort todo incluido de cuatro estrellas en la Zona Hotelera de Cancún, con acceso directo a la playa del Mar Caribe. Cinco restaurantes temáticos, cuatro bares, tres piscinas y entretenimiento nocturno componen una oferta de ocio completa para toda la familia.',
                'address'         => 'Blvd. Kukulcán km 14.5, Zona Hotelera',
                'zip_code'        => '77500',
                'stars'           => 4,
                'services'        => ['Todo incluido', 'Playa privada', '3 piscinas', '5 restaurantes', 'Shows nocturnos', 'Deportes acuáticos', 'Kids club', 'WiFi gratuito', 'Gimnasio'],
                'available_rooms' => 250,
                'price_per_night' => 140.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel8/H8P1.jpg', 'ImagesProduccion/Hotels/Hotel8/H8P2.jpg', 'ImagesProduccion/Hotels/Hotel8/H8P3.jpg'],
                'extras'          => ['Todo incluido' => 0, 'Premium todo incluido' => 40, 'Suite con jacuzzi' => 80],
            ],
            [
                'location_id'     => 9,
                'name'            => 'The Crown & Keys',
                'description'     => 'Elegante hotel boutique de cuatro estrellas en el barrio de Covent Garden, a escasos minutos de la Ópera Real y el Museo Británico. El edificio victoriano restaurado alberga habitaciones de diseño que combinan herencia británica y modernidad. El pub del hotel, con más de 200 referencias de whisky, es un favorito de los locales.',
                'address'         => 'Long Acre 42, Covent Garden',
                'zip_code'        => 'WC2E 9JT',
                'stars'           => 4,
                'services'        => ['WiFi gratuito', 'Pub irlandés', 'Restaurante británico', 'Bar de whisky', 'Conserjería', 'Lavandería', 'Seguridad 24h'],
                'available_rooms' => 68,
                'price_per_night' => 180.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel9/H9P1.jpg', 'ImagesProduccion/Hotels/Hotel9/H9P2.jpg', 'ImagesProduccion/Hotels/Hotel9/H9P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno inglés' => 20, 'Media pensión' => 45],
            ],
            [
                'location_id'     => 10,
                'name'            => 'Harbour View Hotel',
                'description'     => 'Hotel de cinco estrellas con las mejores vistas al Puerto de Sídney, a tres minutos de la Ópera y el Harbour Bridge. El restaurante en planta 30 es considerado uno de los mejores de la ciudad, con una carta de vinos australianos excepcional y vistas al puerto imposibles de olvidar.',
                'address'         => 'Circular Quay West 2, CBD',
                'zip_code'        => 'NSW 2000',
                'stars'           => 5,
                'services'        => ['WiFi gratuito', 'Piscina con vistas al puerto', 'Spa', 'Restaurante panorámico', 'Bar de vinos', 'Gimnasio', 'Servicio de habitaciones 24h', 'Business center'],
                'available_rooms' => 150,
                'price_per_night' => 230.00,
                'images'          => ['ImagesProduccion/Hotels/Hotel10/H10P1.jpg', 'ImagesProduccion/Hotels/Hotel10/H10P2.jpg', 'ImagesProduccion/Hotels/Hotel10/H10P3.jpg'],
                'extras'          => ['Solo alojamiento' => 0, 'Desayuno incluido' => 28, 'Media pensión' => 60],
            ],
        ];

        foreach ($hotels as $data) {
            Hotel::create($data);
        }
    }
}
