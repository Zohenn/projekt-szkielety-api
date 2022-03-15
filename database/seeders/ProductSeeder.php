<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('products')->insert(array(
            array(
                'id' => '1',
                'name' => 'SilentiumPC Signum SG7V TG',
                'category_id' => '1',
                'price' => '369.00',
                'amount' => '0',
                'description' => 'Obudowa Signum SG7V TG to połączenie ponadprzeciętnej w segmencie przestronności i funkcjonalności z wyjątkowo wysokim poziomem wentylacji, a tym samym bardzo skutecznym chłodzeniem komponentów zainstalowanych w środku PC-a. Zapewniają to seryjnie zamontowane cztery wentylatory wysokociśnieniowe (Sigma HP) jak i przewiewny front typu „mesh”. Wyróżnikiem obudów Signum SG7V jest możliwość zamontowania chłodnic o maksymalnym rozmiarze 240/280/360 z przodu jak i na górze – także jednocześnie!',
                'image' => '1.jpg'
            ),
            array(
                'id' => '2',
                'name' => 'SilentiumPC Signum SG1M Pure Black',
                'category_id' => '1',
                'price' => '185.00',
                'amount' => '4',
                'description' => 'SilentiumPC Signum SG1M, to członek nowej rodziny obudów wyróżniający się ponadprzeciętną przestronnością, uniwersalnością i wysokim poziomem wentylacji. A to wszystko w segmencie skrojonym pod najlepszy stosunek możliwości do ceny. Elementem wyróżniającym jest zwarta konstrukcja, specjalnie zaprojektowana platforma montażowa m.in. dla płyty głównej, charakterystyczny front z szerokimi wlotami powietrza i metalowym panelem, wentylator Sigma HP 120 mm, a także pełny zestaw filtrów przeciwkurzowych.

Seria obudów Signum SG1 składa się z pięciu przedstawicieli. Wszystkie wykorzystują tą samą, zwartą i dwukomorową konstrukcję nastawioną na wysoki przepływ powietrza, a także na maksymalną w tym segmencie funkcjonalność. Świadczy o tym m.in. możliwość instalacji zintegrowanych zestawów chłodzenia cieczą z radiatorami o wielkości 120, 240 lub 360 mm z przodu, a także 120/240 na topie. Na tylnej ściance, w miejscu wentylatora Sigma HP, możliwy jest montaż kolejnej chłodnicy o rozmiarze 120 mm.',
                'image' => '2.jpg'
            ),
            array(
                'id' => '3',
                'name' => 'Intel Core i5-10400F',
                'category_id' => '2',
                'price' => '589.00',
                'amount' => '4',
                'description' => 'Wydajny procesor desktopowy dla Twojego komputera! Intel Core i5-10400F korzysta z najważniejszych zmian wprowadzonych przez serię Comet Lake. Gwarantuje wzrost wydajności względem poprzednich generacji, przy jednoczesnym utrzymaniu doskonałej sprawności energetycznej. Takie połączenie zapewnia niebywałą funkcjonalność, z której skorzystać w pracy, podczas nauki i w trakcie grania.

Procesor Intel Core i5-10400F został wykonany w nowoczesnym procesie technologicznym 14 nm. Wykorzystuje on sześć fizycznych rdzeni i dwanaście wątków logicznych. Wysoka częstotliwość taktowania oraz pojemna pamięć podręczna pozwolą Ci na obsługę nie tylko podstawowych programów i narzędzi, ale również tych najbardziej wymagających pod względem sprzętowym. Otwiera on również dostęp do nowych gier z segmentu AAA. Dzięki i5-10400F możesz liczyć na znacznie więcej!',
                'image' => '3.jpg'
            ),
            array(
                'id' => '4',
                'name' => 'Intel Core i7-10700K',
                'category_id' => '2',
                'price' => '1559.00',
                'amount' => '5',
                'description' => 'Od teraz moc Twojego procesora zawsze będzie spełniała wymagania stawiane przez obsługiwane przez Ciebie gry i programy! Intel Core i7-10700K dysponuje wysoką częstotliwością taktowania oraz odblokowanym mnożnikiem, dzięki któremu dodatkowo zwiększysz dostępne wartości.

Jest to więc doskonały procesor do obsługi najbardziej wymagających programów projektowych, a także wszystkich nowych gier – niezależnie od tego, czy interesują Cię klasyki, produkcji indie czy najnowsze tytuły z segmentu AAA. Zawsze możesz liczyć na doskonałą wydajność, zwiększaną w najważniejszych momentach dzięki implementacji nowoczesnych technologii.',
                'image' => '4.jpg'
            ),
            array(
                'id' => '5',
                'name' => 'Manli GTX 1050Ti 4GB',
                'category_id' => '3',
                'price' => '1598.00',
                'amount' => '4',
                'description' => 'Każdy zasługuje, by cieszyć się fantastycznym gamingiem. Dlatego właśnie stworzyliśmy szybką i potężną kartę GeForce® GTX 1050 Ti. Teraz możesz zamienić swój komputer PC w prawdziwy gamingowy zestaw oparty na architekturze NVIDIA Pascal™ najbardziej zaawansowanej gamingowej architekturze GPU jaka kiedykolwiek powstała. Jest ona naszpikowana innowacyjnymi technologiami NVIDIA Game Ready, dzięki którym każdy gracz będzie mógł cieszyć się najnowszymi grami w ich pełnej okazałości. #GameReady.

Karty graficzne GeForce GTX z serii 10 oparte są na architekturze Pascal, oferując nawet trzykrotnie wyższą wydajność w porównaniu do kart graficznych poprzedniej generacji. Zapewniają obsługę przełomowych technologii gamingowych.',
                'image' => '5.jpg'
            ),
            array(
                'id' => '6',
                'name' => 'ASRock Radeon RX 550 Phantom Gaming 2GB',
                'category_id' => '3',
                'price' => '819.00',
                'amount' => '5',
                'description' => 'Układ graficzny AMD Radeon RX 550 zapewni odpowiednie parametry do gier, prac graficznych oraz oglądania filmów i zdjęć w wysokiej rozdzielczości. To jednostka, która dysponuje do 4 GB pamięci RAM GDDR5 i oferuje taktowanie nawet do 1476 MHz (w zależnosci od modelu). Układ graficzny Radeon RX 550 wykonano w 14 nm procesie technologicznym i oparto o architekturę Polaris. Jest to jednostka łącząca dobre parametry do pracy i gier z energooszczędnością i przystępną ceną.',
                'image' => '6.jpg'
            ),
            array(
                'id' => '7',
                'name' => 'Asus PRIME B460-PLUS',
                'category_id' => '4',
                'price' => '469.00',
                'amount' => '5',
                'description' => 'ASUS Prime jest fachowo zaprojektowana tak, aby uwolnić pełny potencjał procesorów Intel 10 generacji. Oferując solidną konstrukcję zasilania, kompleksowe rozwiązania chłodzące i inteligentne opcje dostrajania, płyty główne z serii Prime B460 zapewniają codziennym użytkownikom i konstruktorom komputerów PC szereg opcji dostrajania wydajności za pomocą dołączonego oprogramowania i sprzętu.',
                'image' => '7.jpg'
            ),
            array(
                'id' => '8',
                'name' => 'ASRock H470M-HVS',
                'category_id' => '4',
                'price' => '309.00',
                'amount' => '5',
                'description' => 'Płyta główna z socketem 1200 jest kompatybilna z procesorami Comet Lake-S marki Intel. Wykorzystano w niej zmodyfikowaną konstrukcję LGA 1151 z dodatkowymi pinami, dzięki czemu uzyskano lepszy przepływ mocy. Podstawka LGA 1200 jest kompatybilna z pamięcią DDR4, a jej konstrukcja pozwala na optymalne wykorzystanie potencjału procesorów Intel Core 10. generacji.',
                'image' => '8.jpg'
            ),
            array(
                'id' => '9',
                'name' => 'Patriot Viper 4, DDR4, 8 GB, 3000MHz, CL16',
                'category_id' => '5',
                'price' => '213.00',
                'amount' => '5',
                'description' => 'Patriot Memory to wiodący producent pamięci, który od blisko 30 lat cieszy się uznaniem klientów na całym świecie, Wysoką pozycję na rynku zawdzięcza odważnemu wdrażaniu innowacyjnych i często nagradzanych rozwiązań, oraz rygorystycznemu przestrzeganiu najwyższych standardów jakości, na każdym etapie produkcji.

Linia Viper 4 to dla amerykańskiego producenta produkt flagowy. Ideą było tu zaprojektowanie pamięci o bezkompromisowej wydajności, zoptymalizowanych tak, by dawać zdecydowanie lepsze wsparcie procesorom CPU i GPU oraz umożliwić szybszą komunikację z dyskiem w trakcie rozgrywki w najbardziej wymagające tytuły.',
                'image' => '9.jpg'
            ),
            array(
                'id' => '10',
                'name' => 'HyperX Fury RGB, DDR4, 16 GB, 3200MHz, CL16',
                'category_id' => '5',
                'price' => '462.00',
                'amount' => '5',
                'description' => 'Pamięć HyperX® FURY DDR4 RGB1 to potężny ładunek wydajności w stylowym opakowaniu. Częstotliwość taktowania do 3466MHz2,, odważna stylistyka oraz płynne, olśniewające efekty podświetlenia RGB na całej długości modułu. Pamięć FURY DDR4 RGB obsługuje profile XMP, częstotliwości taktowania 2400MHz–3466MHz i opóźnienia CL15–16. Pojemność jednego modułu wynosi 8GB lub 16GB, a pojemność zestawu – od 16GB do 64GB. Zwiększ wydajność gier, edycji plików wideo i renderowania. Moduły o częstotliwościach 2400MHz oraz 2666MHz obsługują funkcję automatycznego przetaktowywania Plug and Play i są zgodne z najnowszymi procesorami Intel i AMD. Każdy moduł pamięci FURY DDR4 RGB przechodzi testy przy pełnej szybkości i jest objęty wieczystą gwarancją. To bezproblemowa i przystępna cenowo modernizacja systemu.',
                'image' => '10.jpg'
            ),
            array(
                'id' => '11',
                'name' => 'SilentiumPC Vero L3 500W',
                'category_id' => '6',
                'price' => '207.00',
                'amount' => '5',
                'description' => 'Zasilacz komputerowy ATX Vero L3 500 W to bardzo wysoka sprawność, potwierdzona certyfikatem 80 PLUS® Bronze 230V, nowoczesne i wydajne konwertery DC-DC, niezwykle mocna pojedyncza linia +12 V, bardzo ciche działanie w dużym zakresie obciążenia, a także bogaty zestaw płaskiego i czarnego okablowania. Potwierdzeniem wysokiej jakości jest 3-letnia gwarancja w wygodnym systemie door-to-door.',
                'image' => '11.jpg'
            ),
            array(
                'id' => '12',
                'name' => 'be quiet! Straight Power 11 750W',
                'category_id' => '6',
                'price' => '449.00',
                'amount' => '5',
                'description' => 'be quiet! Straight Power 11 750W podnosi poprzeczkę dla systemów, które wymagają praktycznie niesłyszalnej pracy bez kompromisów w jakości zasilania.

Straight Power 11 750W posiada certyfikat sprawności 80PLUS® Gold, osiągając nawet 93%. Zapewnia to mniejsze zużycie energii oraz chłodniejszą i cichszą pracę. To duża korzyść dla każdego systemu.',
                'image' => '12.jpg'
            ),
            array(
                'id' => '13',
                'name' => 'SilentiumPC Fera 3 HE1224 v2',
                'category_id' => '7',
                'price' => '103.00',
                'amount' => '5',
                'description' => 'SilentiumPC Fera 3 HE1224 v2 to bardzo wydajny zestaw chłodzący wykorzystujący asymetryczny radiator, przeznaczony do procesorów o TDP do 180W. W jego konstrukcji wykorzystano cztery wysokiej jakości rurki cieplne (heatpipe) 6 mm oraz zoptymalizowany pod kątem cichej pracy wentylator Sigma Pro 120 PWM.',
                'image' => '13.jpg'
            ),
            array(
                'id' => '14',
                'name' => 'be quiet! Dark Rock 4',
                'category_id' => '7',
                'price' => '312.00',
                'amount' => '5',
                'description' => 'Seria Dark Rock 4 oferuje ekstremalną wydajność chłodzenia do 200W TDP i praktycznie niesłyszalną pracę. Dedykowana do podkręconych systemów i wymagających stacji roboczych.',
                'image' => '14.jpg'
            ),
            array(
                'id' => '15',
                'name' => 'Microsoft Windows 10 Home PL 32 bit 64 bit',
                'category_id' => '8',
                'price' => '559.00',
                'amount' => '5',
                'description' => 'System Microsoft Windows 10 w wersji do użytku domowego.',
                'image' => '15.jpeg'
            ),
            array(
                'id' => '16',
                'name' => 'Microsoft Windows 10 Professional PL 32 bit 64 bit',
                'category_id' => '8',
                'price' => '999.00',
                'amount' => '5',
                'description' => 'System Microsoft Windows 10 w wersji do użytku profesjonalnego',
                'image' => '16.jpeg'
            ),
            array(
                'id' => '17',
                'name' => 'ADATA Ultimate SU800 256 GB',
                'category_id' => '9',
                'price' => '185.00',
                'amount' => '5',
                'description' => 'Dysk półprzewodnikowy SU800 zasługuje na swoją totalną nazwę Ultimate dzięki pamięci Flash NAND 3D, która zapewnia większą gęstość zapisu, wydajność oraz niezawodność niż tradycyjna pamięć NAND 2D. Wyposażony jest w inteligentny system buforowania SLC oraz bufor DRAM jeszcze bardziej zwiększający wydajność odczytu/zapisu. Ponadto funkcje LDPC ECC oraz technologie, takie jak wysokie TBW (całkowita liczba zapisanych bitów) oraz DEVSLP (tryb uśpienia urządzenia) powodują, że Ultimate SU800 natychmiast przenosi nasz laptop lub komputer stacjonarny na poziom nadzwyczajnej stabilności, wytrzymałości oraz niesłychanej wydajności. Ponadto użytkownicy mogą pobrać za darmo opracowany przez ADATA zestaw narzędziowy SSD oraz oprogramowanie migracyjne, aby cieszyć się łatwym zarządzaniem i migracją danych.',
                'image' => '17.jpg'
            ),
            array(
                'id' => '18',
                'name' => 'Lexar NM620 1 TB',
                'category_id' => '9',
                'price' => '499.00',
                'amount' => '5',
                'description' => 'Zaprojektowany z myślą o intensywnych obciążeniach dysk SSD Lexar NM620 oferuje wydajność na wyższym poziomie oferując prędkość odczytu do 3300 MB/s oraz zapisu do 3000 MB/s. Dysk NM620 obsługuje technologię PCIe Gen3x4 NVMe 1.4 oraz korzysta z najnowszej pamięci flash 3D NAND.

Zmniejszone zużycie energii i sprawne chłodzenie sprawiają, że żywotność NM620 jest o wiele dłuższa niż w przypadku tradycyjnego dysku twardego.',
                'image' => '18.jpg'
            ),
            array(
                'id' => '19',
                'name' => 'Seagate BarraCuda 1 TB',
                'category_id' => '10',
                'price' => '159.00',
                'amount' => '5',
                'description' => 'Wszystkie dyski twarde należące do rodziny BarraCuda są wyposażone w technologię wielopoziomowego buforowania Multi-Tier Caching (MTC). Technologia MTC pozwala na osiągnięcie nowego poziomu wydajności w komputerach osobistych, umożliwiając szybsze ładowanie aplikacji i plików. Dysk BarraCuda oferuje wyższą wydajność odczytu i zapisu, wykorzystując inteligentne warstwy pamięci NAND Flash, DRAM oraz technologię buforowania nośników do optymalizacji przepływu danych.',
                'image' => '19.jpg'
            ),
            array(
                'id' => '20',
                'name' => 'Toshiba P300 2 TB',
                'category_id' => '10',
                'price' => '249.00',
                'amount' => '5',
                'description' => '3,5-calowy wewnętrzny dysk twardy Toshiba P300 to gwarancja wysokiej wydajności dla profesjonalistów. Dzięki technologii dwuetapowego ruchu głowicy można liczyć na płynne, szybkie reakcje urządzenia. Poza tym dane i multimedia są chronione przez technologię parkowania głowicy, zapobiegającą uszkodzeniom w czasie przenoszenia, a także czujnik wstrząsów.',
                'image' => '20.jpg'
            )
        ));
    }
}
