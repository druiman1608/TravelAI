<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            ['user_id' => 3, 'hotel_id' => 5,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'Una experiencia absolutamente increíble. El Desert Pearl Resort es la definición del lujo: la playa privada, el butler service y la suite con vistas a la Palm Jumeirah son simplemente perfectos. Repetiría sin dudarlo.'],
            ['user_id' => 4, 'hotel_id' => 1,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El Hotel Real Palacio superó todas mis expectativas. La ubicación es inmejorable, el desayuno excelente y el personal extremadamente atento. La vista desde la azotea al atardecer es un espectáculo que no olvidaré.'],
            ['user_id' => 5, 'hotel_id' => 8,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 4, 'status' => 'approved', 'comment' => 'El Paradise Beach Resort tiene todo lo que necesitas: playa increíble, piscinas geniales y animación toda la noche. La comida podría mejorar un poco pero el ambiente y la ubicación son difíciles de superar.'],
            ['user_id' => 6, 'hotel_id' => 6,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El Tropical Haven Bali es un paraíso escondido. Despertarse escuchando el agua y rodeada de arrozales, con yoga al amanecer y masajes ayurvédicos... No me quería ir nunca. Los desayunos son una obra de arte.'],
            ['user_id' => 7, 'hotel_id' => 7,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 4, 'status' => 'approved', 'comment' => 'El Mediterráneo Grand está en la mejor ubicación posible de Barcelona. A dos minutos de Gaudí, con una terraza con piscina espectacular. La habitación era amplia y muy limpia. Solo le falta algo más de variedad en el desayuno.'],
            ['user_id' => 8, 'hotel_id' => 9,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 4, 'status' => 'approved', 'comment' => 'The Crown & Keys es el hotel boutique perfecto en Londres. El pub del hotel es una maravilla, con una selección de cervezas artesanales y whisky espectacular. Covent Garden es una zona ideal. Lo recomiendo totalmente.'],
            ['user_id' => 3, 'hotel_id' => 3,  'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El Sakura Grand Hotel en Shinjuku es una experiencia cultural en sí misma. El onsen en la planta 40 con vistas nocturnas a Tokio es simplemente irreal. El personal, la limpieza y la gastronomía son de un nivel altísimo.'],
            ['user_id' => 4, 'hotel_id' => 10, 'activity_id' => null, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El Harbour View Hotel te da las mejores vistas de Sídney desde la primera mañana. Desayunar viendo la Ópera y el Harbour Bridge no tiene precio. El restaurante panorámico es excepcional. Una joya absoluta.'],

            ['user_id' => 3, 'hotel_id' => null, 'activity_id' => 5, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El Spa de Lujo en el Desierto es una experiencia transformadora. El hammam árabe, el masaje de oud y la envoltura hidratante me dejaron como nueva. El entorno del desierto añade una magia especial que ningún spa urbano puede replicar.'],
            ['user_id' => 6, 'hotel_id' => null, 'activity_id' => 6, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'Las olas de Uluwatu son mágicas y el instructor fue increíble con principiantes. Conseguí mantenerme de pie en la tabla varias veces en la primera sesión. El vídeo del final es un recuerdo impagable. ¡Repetiré seguro!'],
            ['user_id' => 5, 'hotel_id' => null, 'activity_id' => 7, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El rafting en el Noguera Pallaresa fue la actividad más emocionante que he hecho nunca. Los rápidos de grado IV te ponen el corazón en la garganta. El guía era profesional y divertido. El almuerzo de montaña al final fue el broche perfecto.'],
            ['user_id' => 4, 'hotel_id' => null, 'activity_id' => 8, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El snorkel en el Arrecife Mesoamericano fue absolutamente mágico. Ver tortugas marinas tan de cerca fue un sueño hecho realidad. El guía biológico conocía cada especie y el almuerzo en la isla fue delicioso. Una experiencia de 10.'],
            ['user_id' => 7, 'hotel_id' => null, 'activity_id' => 1, 'flight_id' => null, 'package_id' => null, 'rating' => 4, 'status' => 'approved', 'comment' => 'La escalada en La Pedriza fue una aventura brutal. El paisaje granítico es impresionante y el guía nos enseñó las técnicas básicas perfectamente. Las vistas desde arriba de Madrid compensan todo el esfuerzo. Recomendado para amantes de la montaña.'],
            ['user_id' => 8, 'hotel_id' => null, 'activity_id' => 9, 'flight_id' => null, 'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'El senderismo por los Cotswolds fue como entrar en un cuento de hadas. Los pueblos de piedra dorada, los prados verdes y el pub del siglo XVIII al final del recorrido hacen de este tour algo muy especial. El guía fue excepcional.'],

            ['user_id' => 3, 'hotel_id' => null, 'activity_id' => null, 'flight_id' => 3,  'package_id' => null, 'rating' => 5, 'status' => 'approved', 'comment' => 'Emirates superó mis expectativas en todos los sentidos. El espacio, la comida y el entretenimiento a bordo son de primera clase incluso en economy. Llegamos puntuales y el servicio fue impecable durante todo el vuelo.'],
            ['user_id' => 5, 'hotel_id' => null, 'activity_id' => null, 'flight_id' => 7,  'package_id' => null, 'rating' => 4, 'status' => 'approved', 'comment' => 'Delta cumplió perfectamente en el vuelo Nueva York-Cancún. Puntual, personal amable y el precio fue muy competitivo. La maleta llegó en buen estado y el embarque fue rápido. Lo recomendaría para rutas caribeñas.'],
            ['user_id' => 8, 'hotel_id' => null, 'activity_id' => null, 'flight_id' => 13, 'package_id' => null, 'rating' => 4, 'status' => 'approved', 'comment' => 'Vueling de Barcelona a París, un vuelo perfecto para el precio que pagué. Puntual, asientos cómodos y el proceso de embarque muy organizado. Para una ruta corta europea, es la opción ideal.'],

            ['user_id' => 3, 'hotel_id' => null, 'activity_id' => null, 'flight_id' => null, 'package_id' => 3, 'rating' => 5, 'status' => 'approved', 'comment' => 'El paquete Tokio Experience fue el viaje de mi vida. Todo perfectamente coordinado: el Sakura Grand Hotel es un cinco estrellas de verdad, el Shinkansen a Niseko fue una experiencia en sí misma y la nieve de Hokkaido es la mejor que he pisado.'],
            ['user_id' => 7, 'hotel_id' => null, 'activity_id' => null, 'flight_id' => null, 'package_id' => 1, 'rating' => 5, 'status' => 'approved', 'comment' => 'El paquete Maravillas de Madrid lo tiene todo: hotel de lujo en el centro histórico, vuelo cómodo y la escalada en La Pedriza fue una sorpresa increíble. TravelAI organiza todo al detalle, no tuve que preocuparme de nada.'],
            ['user_id' => 8, 'hotel_id' => null, 'activity_id' => null, 'flight_id' => null, 'package_id' => 9, 'rating' => 5, 'status' => 'approved', 'comment' => 'Londres Clásico fue un paquete perfecto para descubrir la ciudad. The Crown & Keys en Covent Garden es una ubicación ideal, los Cotswolds son un paraíso verde y el vuelo desde Madrid fue muy cómodo. Totalmente recomendado.'],
        ];

        foreach ($reviews as $data) {
            Review::create($data);
        }
    }
}
