<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $activities = [
            [
                'location_id'       => 1,
                'name'              => 'Escalada en La Pedriza',
                'description'       => 'Adéntrate en las impresionantes formaciones graníticas de La Pedriza, en el Parque Nacional de la Sierra de Guadarrama. Nuestros guías certificados te llevarán por rutas adaptadas a tu nivel, desde iniciación hasta vías de escalada avanzadas. La actividad incluye todo el material técnico y finaliza con una sesión de fotos en las cimas con vistas panorámicas a Madrid.',
                'duration'          => '6 horas',
                'price'             => 68.00,
                'type'              => 'Aventura',
                'included_features' => ['Guía certificado UIAA', 'Todo el material técnico', 'Seguro de actividades', 'Transporte desde Madrid', 'Picnic en la cumbre'],
                'images'            => ['ImagesProduccion/Activities/Climbing/ClimbingP1.jpg', 'ImagesProduccion/Activities/Climbing/ClimbingP2.jpg', 'ImagesProduccion/Activities/Climbing/ClimbingP3.jpg'],
                'extras'            => ['Seguro de accidentes premium' => 8, 'Pack fotos y vídeo HD' => 20, 'Guía privado' => 45],
            ],
            [
                'location_id'       => 2,
                'name'              => 'Tour Gastronómico por París',
                'description'       => 'Descubre los secretos culinarios de París con un chef de formación en Le Cordon Bleu. El tour recorre los mejores mercados del barrio de Montmartre, visita fromageries y charcuteries históricas, y culmina con una cena de degustación de cinco platos maridada con vinos de Borgoña. Una experiencia que te hará comprender por qué la gastronomía francesa es Patrimonio Inmaterial de la Humanidad.',
                'duration'          => '5 horas',
                'price'             => 95.00,
                'type'              => 'Cultural',
                'included_features' => ['Chef guía certificado', 'Degustaciones en mercados', 'Cena de 5 platos', 'Maridaje de vinos', 'Recetario exclusivo'],
                'images'            => ['ImagesProduccion/Activities/Gastronomy/GastronomyP1.jpg', 'ImagesProduccion/Activities/Gastronomy/GastronomyP2.jpg', 'ImagesProduccion/Activities/Gastronomy/GastronomyP3.jpg'],
                'extras'            => ['Clase de cocina privada' => 60, 'Cata de quesos premium' => 25, 'Maridaje de champagne' => 35],
            ],
            [
                'location_id'       => 3,
                'name'              => 'Snowboard en Niseko',
                'description'       => 'Niseko, en la isla de Hokkaido, es reconocida como uno de los mejores destinos de snowboard del mundo gracias a su nieve en polvo incomparable. Nuestro paquete incluye transfer desde Tokio en el Shinkansen, un día completo en las pistas con instructor nativo y acceso a las noches de esquí. Termina la jornada en un onsen al aire libre rodeado de nieve.',
                'duration'          => '2 días',
                'price'             => 285.00,
                'type'              => 'Aventura',
                'included_features' => ['Transfer Tokio-Niseko en Shinkansen', 'Material completo de snowboard', 'Instructor certificado', 'Forfait de día completo', 'Onsen nocturno'],
                'images'            => ['ImagesProduccion/Activities/Snowboard/SnowboardingP1.jpg', 'ImagesProduccion/Activities/Snowboard/SnowboardingP2.jpg', 'ImagesProduccion/Activities/Snowboard/SnowboardingP3.jpg'],
                'extras'            => ['Seguro de montaña' => 15, 'Clases privadas de snowboard' => 80, 'Alquiler equipo premium' => 30],
            ],
            [
                'location_id'       => 4,
                'name'              => 'Salto en Paracaídas sobre Manhattan',
                'description'       => 'Experimenta la adrenalina máxima saltando desde 4.000 metros de altura sobre las afueras de Nueva York con vistas al skyline de Manhattan. El salto en tándem con un instructor experto incluye 60 segundos de caída libre a 200 km/h y 8 minutos de planeo suave en parapente. Incluye vídeo y fotos HD del salto completo para que puedas compartir el momento más emocionante de tu vida.',
                'duration'          => '4 horas',
                'price'             => 250.00,
                'type'              => 'Aventura',
                'included_features' => ['Salto en tándem con instructor', 'Briefing y entrenamiento previo', 'Vídeo y fotos HD del salto', 'Transfer desde Manhattan', 'Certificado de salto'],
                'images'            => ['ImagesProduccion/Activities/Parachuting/ParachutingP1.jpg', 'ImagesProduccion/Activities/Parachuting/ParachutingP2.jpg', 'ImagesProduccion/Activities/Parachuting/ParachutingP3.jpg'],
                'extras'            => ['Edición de vídeo cinematográfico' => 40, 'Seguro de actividad extrema' => 20, 'Transfer privado' => 50],
            ],
            [
                'location_id'       => 5,
                'name'              => 'Spa de Lujo en el Desierto',
                'description'       => 'Vive una experiencia de relajación y bienestar única en el corazón del desierto de Dubái. El spa cinco estrellas ofrece tratamientos inspirados en la tradición árabe: hammam con exfoliación de argán, masaje con aceites de oud, envoltura de oro 24k y baño de flores. La sesión incluye acceso a los espacios termales premium y té de hierbas árabes.',
                'duration'          => '4 horas',
                'price'             => 175.00,
                'type'              => 'Relajación',
                'included_features' => ['Hammam tradicional árabe', 'Masaje con aceites de oud', 'Envoltura hidratante', 'Acceso a espacios termales', 'Té de hierbas árabes y dátiles'],
                'images'            => ['ImagesProduccion/Activities/Spa/SpaP1.jpg', 'ImagesProduccion/Activities/Spa/SpaP2.jpg', 'ImagesProduccion/Activities/Spa/SpaP3.jpg'],
                'extras'            => ['Envoltura de oro 24k' => 60, 'Masaje de pareja' => 80, 'Acceso a piscina privada' => 40],
            ],
            [
                'location_id'       => 6,
                'name'              => 'Surf en Uluwatu',
                'description'       => 'Uluwatu es uno de los breaks de surf más famosos del mundo, con olas perfectas que rompen sobre los acantilados de coral. Nuestros instructores profesionales con más de diez años de experiencia te enseñarán desde los fundamentos hasta técnicas avanzadas. La sesión incluye calentamiento en tierra, práctica en el agua y visionado de vídeo para analizar tu técnica.',
                'duration'          => '3 horas',
                'price'             => 65.00,
                'type'              => 'Aventura',
                'included_features' => ['Instructor profesional certificado', 'Tabla de surf y lycra', 'Vídeo de la sesión', 'Hidratación durante la actividad', 'Ducha y taquilla'],
                'images'            => ['ImagesProduccion/Activities/Surf/SurfP1.jpg', 'ImagesProduccion/Activities/Surf/SurfP2.jpg', 'ImagesProduccion/Activities/Surf/SurfP3.jpg'],
                'extras'            => ['Clase privada de surf' => 40, 'Sesión de fotografía acuática' => 35, 'Alquiler de tabla premium' => 15],
            ],
            [
                'location_id'       => 7,
                'name'              => 'Rafting en el Pirineo Catalán',
                'description'       => 'El río Noguera Pallaresa, a dos horas de Barcelona, ofrece algunos de los mejores rápidos de Europa para el rafting. Nuestros guías expertos te llevan a través de rápidos de grado III y IV, con tramos de adrenalina pura intercalados con zonas de aguas tranquilas para recuperar el aliento. Una aventura perfecta para grupos y familias con adolescentes.',
                'duration'          => '8 horas',
                'price'             => 75.00,
                'type'              => 'Aventura',
                'included_features' => ['Equipo completo de seguridad', 'Guía experto en aguas bravas', 'Transfer desde Barcelona', 'Almuerzo de montaña', 'Seguro de actividades'],
                'images'            => ['ImagesProduccion/Activities/Rafting/RaftingP1.jpg', 'ImagesProduccion/Activities/Rafting/RaftingP2.jpg', 'ImagesProduccion/Activities/Rafting/RaftingP3.jpg'],
                'extras'            => ['Pack fotos y vídeo profesional' => 22, 'Traje de neopreno premium' => 10, 'Cena de grupo en restaurante' => 28],
            ],
            [
                'location_id'       => 8,
                'name'              => 'Snorkel en el Arrecife Mesoamericano',
                'description'       => 'El Arrecife Mesoamericano, el segundo más grande del mundo, ofrece una biodiversidad marina extraordinaria frente a las costas de Cancún. Nuestro barco te llevará a tres puntos de snorkel de primer nivel donde podrás observar tortugas marinas, rayas, meros gigantes y más de 200 especies de peces tropicales. Incluye parada en una isla para el almuerzo.',
                'duration'          => '6 horas',
                'price'             => 55.00,
                'type'              => 'Naturaleza',
                'included_features' => ['Equipo de snorkel profesional', 'Chaleco salvavidas', 'Guía biológico marino', 'Almuerzo en isla', 'Bebidas no alcohólicas'],
                'images'            => ['ImagesProduccion/Activities/Snorkel/SnorkelingP1.jpg', 'ImagesProduccion/Activities/Snorkel/SnorkelingP2.jpg', 'ImagesProduccion/Activities/Snorkel/SnorkelingP3.jpg'],
                'extras'            => ['Equipo fotográfico subacuático' => 18, 'Pack fotos underwater' => 25, 'Bautismo de buceo' => 45],
            ],
            [
                'location_id'       => 9,
                'name'              => 'Senderismo por los Cotswolds',
                'description'       => 'Los Cotswolds, con sus pueblos de piedra dorada y prados infinitos, son el corazón rural de Inglaterra. Esta ruta de día completo te lleva por los caminos más pintorescos de la región, pasando por Bourton-on-the-Water, Burford y Bibury. El paseo termina con una merienda tradicional en un pub del siglo XVIII donde podrás degustar los mejores ales artesanales ingleses.',
                'duration'          => '9 horas',
                'price'             => 58.00,
                'type'              => 'Naturaleza',
                'included_features' => ['Transfer desde Londres en minibús', 'Guía experto en historia rural', 'Merienda en pub histórico', 'Mapa de la ruta', 'Seguro de actividades'],
                'images'            => ['ImagesProduccion/Activities/Hiking/HikingP1.jpg', 'ImagesProduccion/Activities/Hiking/HikingP2.jpg', 'ImagesProduccion/Activities/Hiking/HikingP3.jpg'],
                'extras'            => ['Almuerzo de picnic gourmet' => 18, 'Guía privado' => 40, 'Bastones de senderismo' => 5],
            ],
            [
                'location_id'       => 10,
                'name'              => 'Kayak en el Puerto de Sídney',
                'description'       => 'Explora el impresionante Puerto de Sídney desde el agua en un kayak doble o individual. La ruta matinal pasa bajo el Harbour Bridge, rodea la Ópera de Sídney y descubre calas escondidas inaccesibles desde tierra. Los guías locales comparten la historia y las leyendas del puerto mientras observas los ferris, veleros y ocasionalmente delfines y pingüinos de hadas.',
                'duration'          => '3 horas',
                'price'             => 85.00,
                'type'              => 'Aventura',
                'included_features' => ['Kayak y material de seguridad', 'Guía local certificado', 'Snack y bebida a bordo', 'Fotografías del tour', 'Seguro de actividades'],
                'images'            => ['ImagesProduccion/Activities/Kayak/KayakP1.jpg', 'ImagesProduccion/Activities/Kayak/KayakP2.jpg', 'ImagesProduccion/Activities/Kayak/KayakP3.jpg'],
                'extras'            => ['Kayak individual (upgrade)' => 15, 'Sesión de fotografía' => 25, 'Tour al amanecer (salida 5:30h)' => 10],
            ],
        ];

        foreach ($activities as $data) {
            Activity::create($data);
        }
    }
}
