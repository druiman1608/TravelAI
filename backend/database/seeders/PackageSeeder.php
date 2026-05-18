<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'hotel_id'       => 1,
                'flight_id'      => 5,
                'activity_id'    => 1,
                'name'           => 'Maravillas de Madrid',
                'description'    => 'Vive la esencia de la capital española con siete noches en el lujoso Hotel Real Palacio, vuelo directo desde Londres y una emocionante experiencia de escalada en La Pedriza. El paquete incluye acceso al spa del hotel, desayuno diario y visita guiada al Museo del Prado.',
                'itinerary'      => ['Día 1: Llegada y bienvenida en el hotel', 'Días 2-3: Museo del Prado, Palacio Real y Parque del Retiro', 'Día 4: Escalada en La Pedriza', 'Días 5-6: Excursión a Toledo y Segovia', 'Día 7: Compras en el Rastro y Malasaña', 'Día 8: Salida'],
                'total_price'    => 1785.00,
                'discount_price' => 1540.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel1/H1P1.jpg', 'ImagesProduccion/Hotels/Hotel1/H1P2.jpg', 'ImagesProduccion/Hotels/Hotel1/H1P3.jpg'],
            ],
            [
                'hotel_id'       => 2,
                'flight_id'      => 13,
                'activity_id'    => 2,
                'name'           => 'Romanticismo en París',
                'description'    => 'La Ciudad del Amor te espera con siete noches en la encantadora Maison Lumière, vuelo desde Barcelona y un exclusivo tour gastronómico con chef. Descubre los mercados, museos y bulevares más bellos del mundo con la guía de nuestros expertos locales.',
                'itinerary'      => ['Día 1: Llegada, paseo nocturno por el Sena', 'Día 2: Louvre y Jardín de las Tullerías', 'Día 3: Tour Gastronómico con chef', 'Día 4: Versalles', 'Día 5: Montmartre y Sacré-Cœur', 'Días 6-7: Libre', 'Día 8: Salida'],
                'total_price'    => 1449.00,
                'discount_price' => 1280.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel2/H2P1.jpg', 'ImagesProduccion/Hotels/Hotel2/H2P2.jpg', 'ImagesProduccion/Hotels/Hotel2/H2P3.jpg'],
            ],
            [
                'hotel_id'       => 3,
                'flight_id'      => 1,
                'activity_id'    => 3,
                'name'           => 'Tokio Experience',
                'description'    => 'Sumérgete en la fascinante metrópolis japonesa con siete noches en el Sakura Grand Hotel, vuelo directo desde Madrid y dos días de snowboard en las legendarias nieves de Niseko. Japón te cambia la vida: tradición, tecnología y gastronomía en un único viaje.',
                'itinerary'      => ['Día 1: Llegada, barrio de Shinjuku', 'Día 2: Templo Senso-ji, Akihabara', 'Días 3-4: Snowboard en Niseko', 'Día 5: Monte Fuji y Hakone', 'Día 6: Harajuku y Shibuya', 'Día 7: Tsukiji y gastronomía', 'Día 8: Salida'],
                'total_price'    => 3315.00,
                'discount_price' => 2980.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel3/H3P1.jpg', 'ImagesProduccion/Hotels/Hotel3/H3P2.jpg', 'ImagesProduccion/Hotels/Hotel3/H3P3.jpg'],
            ],
            [
                'hotel_id'       => 4,
                'flight_id'      => 8,
                'activity_id'    => 4,
                'name'           => 'Nueva York en Grande',
                'description'    => 'La Gran Manzana al máximo nivel: siete noches en el Manhattan Sky Hotel con vistas al Empire State, vuelo desde Cancún y el salto en paracaídas más emocionante con vistas al skyline de Manhattan. Vive la ciudad que nunca duerme sin perderte nada.',
                'itinerary'      => ['Día 1: Llegada, Times Square nocturno', 'Día 2: Museo Metropolitano y Central Park', 'Día 3: Salto en paracaídas', 'Día 4: Brooklyn y la Estatua de la Libertad', 'Día 5: Rockefeller Center y shopping', 'Días 6-7: Libre', 'Día 8: Salida'],
                'total_price'    => 2625.00,
                'discount_price' => 2340.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel4/H4P1.jpg', 'ImagesProduccion/Hotels/Hotel4/H4P2.jpg', 'ImagesProduccion/Hotels/Hotel4/H4P3.jpg'],
            ],
            [
                'hotel_id'       => 5,
                'flight_id'      => 3,
                'activity_id'    => 5,
                'name'           => 'Dubái de Lujo',
                'description'    => 'El lujo absoluto en el destino más opulento del planeta. Siete noches en el Desert Pearl Resort de Palm Jumeirah, vuelo directo desde Madrid y una sesión de spa árabe de cuatro horas en el desierto. El Burj Khalifa, las islas artificiales y los zocos de oro te esperan.',
                'itinerary'      => ['Día 1: Llegada, Burj Khalifa al atardecer', 'Día 2: Dubái Mall y Fountain Show', 'Día 3: Spa de lujo en el desierto', 'Día 4: Safari en 4x4 por las dunas', 'Días 5-6: Palm Jumeirah y playa privada', 'Día 7: Dubái Creek y zocos históricos', 'Día 8: Salida'],
                'total_price'    => 3679.00,
                'discount_price' => 3299.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel5/H5P1.jpg', 'ImagesProduccion/Hotels/Hotel5/H5P2.jpg', 'ImagesProduccion/Hotels/Hotel5/H5P3.jpg'],
            ],
            [
                'hotel_id'       => 6,
                'flight_id'      => 15,
                'activity_id'    => 6,
                'name'           => 'Bali Tropical',
                'description'    => 'Escápate al paraíso con siete noches en la villa privada del Tropical Haven Bali entre arrozales, vuelo desde Dubái y clases de surf en las legendarias olas de Uluwatu. Yoga al amanecer, spa ayurvédico y puestas de sol frente al Índico completan esta experiencia transformadora.',
                'itinerary'      => ['Día 1: Llegada, bienvenida con bebida de coco', 'Día 2: Yoga y templo de Tanah Lot', 'Día 3: Surf en Uluwatu', 'Día 4: Arrozales de Tegallalang y cocina balinesa', 'Día 5: Spa ayurvédico', 'Días 6-7: Seminyak y playas', 'Día 8: Salida'],
                'total_price'    => 1785.00,
                'discount_price' => 1595.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel6/H6P1.jpg', 'ImagesProduccion/Hotels/Hotel6/H6P2.jpg', 'ImagesProduccion/Hotels/Hotel6/H6P3.jpg'],
            ],
            [
                'hotel_id'       => 7,
                'flight_id'      => 11,
                'activity_id'    => 7,
                'name'           => 'Barcelona Vibrante',
                'description'    => 'Descubre la ciudad más creativa de Europa con siete noches en el Mediterráneo Grand del Paseo de Gràcia, vuelo desde Londres y un día de rafting de adrenalina en el Pirineo. Gaudí, playas, tapas y la mejor vida nocturna del Mediterráneo en un solo paquete.',
                'itinerary'      => ['Día 1: Llegada, Las Ramblas', 'Día 2: Sagrada Família y Parque Güell', 'Día 3: Rafting en el Pirineo', 'Día 4: Barceloneta y Born', 'Día 5: Casa Batlló y Pedrera', 'Días 6-7: Libre y playas', 'Día 8: Salida'],
                'total_price'    => 1157.00,
                'discount_price' => 1020.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel7/H7P1.jpg', 'ImagesProduccion/Hotels/Hotel7/H7P2.jpg', 'ImagesProduccion/Hotels/Hotel7/H7P3.jpg'],
            ],
            [
                'hotel_id'       => 8,
                'flight_id'      => 7,
                'activity_id'    => 8,
                'name'           => 'Cancún Paradise',
                'description'    => 'El Caribe mexicano en todo su esplendor: siete noches todo incluido en el Paradise Beach Resort frente al mar, vuelo directo desde Nueva York y snorkel en el Arrecife Mesoamericano con tortugas y rayas. Ruinas mayas y cenotes completan esta aventura tropical perfecta.',
                'itinerary'      => ['Día 1: Llegada, primera jornada de playa', 'Día 2: Snorkel en el arrecife', 'Día 3: Excursión a Chichén Itzá', 'Día 4: Cenote Ik Kil y Tulum', 'Días 5-6: Playa, piscina y deportes acuáticos', 'Día 7: Free shopping', 'Día 8: Salida'],
                'total_price'    => 1260.00,
                'discount_price' => 1099.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel8/H8P1.jpg', 'ImagesProduccion/Hotels/Hotel8/H8P2.jpg', 'ImagesProduccion/Hotels/Hotel8/H8P3.jpg'],
            ],
            [
                'hotel_id'       => 9,
                'flight_id'      => 6,
                'activity_id'    => 9,
                'name'           => 'Londres Clásico',
                'description'    => 'Sumérgete en la historia y la cultura de la capital británica con siete noches en el encantador The Crown & Keys de Covent Garden, vuelo desde Madrid y un día de senderismo por los pintorescos pueblos de los Cotswolds. Teatro West End, pubs victorianos y museos de categoría mundial.',
                'itinerary'      => ['Día 1: Llegada, Tower Bridge y Borough Market', 'Día 2: British Museum y West End', 'Día 3: Senderismo en los Cotswolds', 'Día 4: Buckingham Palace y Hyde Park', 'Día 5: Camden Market y Shoreditch', 'Días 6-7: Libre', 'Día 8: Salida'],
                'total_price'    => 1524.00,
                'discount_price' => 1349.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel9/H9P1.jpg', 'ImagesProduccion/Hotels/Hotel9/H9P2.jpg', 'ImagesProduccion/Hotels/Hotel9/H9P3.jpg'],
            ],
            [
                'hotel_id'       => 10,
                'flight_id'      => 9,
                'activity_id'    => 10,
                'name'           => 'Sídney Aventura',
                'description'    => 'Australia en todo su esplendor con siete noches en el Harbour View Hotel frente a la Ópera de Sídney, vuelo desde Tokio y kayak al amanecer por el impresionante puerto. Bondi Beach, la Gran Barrera de Coral y los cocodrilos de la selva tropical te esperan en este destino único.',
                'itinerary'      => ['Día 1: Llegada, Circular Quay y Ópera', 'Día 2: Kayak en el puerto al amanecer', 'Día 3: Bondi Beach y sendero costero', 'Día 4: Blue Mountains', 'Día 5: Excursión al parque nacional', 'Días 6-7: Libre', 'Día 8: Salida'],
                'total_price'    => 2725.00,
                'discount_price' => 2450.00,
                'images'         => ['ImagesProduccion/Hotels/Hotel10/H10P1.jpg', 'ImagesProduccion/Hotels/Hotel10/H10P2.jpg', 'ImagesProduccion/Hotels/Hotel10/H10P3.jpg'],
            ],
        ];

        foreach ($packages as $data) {
            Package::create($data);
        }
    }
}
