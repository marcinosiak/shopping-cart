<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/brian-tracy/zjedz-te-zabe-21-metod-podnoszenia-wydajnosci-w-pracy-i-zwalczania-sklonnosci-do-zwlekania-duze.jpg',
          'title' => 'Zjedz tę żabę. 21 metod podnoszenia wydajności w pracy',
          'description' => 'Zjedz tę żabę to książka dla ludzi biznesu. Ta przekonująca metafora',
          'price' => 29
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/robert-j-schoenberg/al-capone-duze.jpg',
          'title' => 'Al Capone',
          'description' => 'Legendą stał się jeszcze za życia. Jego nieposkromione ego, inteligencja',
          'price' => 44
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/marek-stelar/niepamiec-duze.jpg',
          'title' => 'Niepamięć',
          'description' => 'Podinspektor Dariusz Suder, kilka tygodni po spotkaniu koordynacyjnym polskich',
          'price' => 18
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/anna-kaminska/simona-duze.jpg',
          'title' => 'Simona',
          'description' => 'Miała być czwartym Kossakiem i przejąć paletę po pradziadku Juliuszu',
          'price' => 23
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/jacek-walkiewicz/pelna-moc-zycia-jesli-o-czyms-w-zyciu-marzysz-siegnij-po-to-wydanie-ii-duze.jpg',
          'title' => 'Pełna MOC życia',
          'description' => 'Skąd się wzięła pełna MOC? Z nagłego błysku w głowie.',
          'price' => 8
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/dominik-dan/czerwony-kapitan-duze.jpg',
          'title' => 'Czerwony Kapitan',
          'description' => 'kcja “Czerwonego Kapitana” dzieje się w 1992 r., tuż po transformacji ustrojowej',
          'price' => 25
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/remigiusz-mroz/w-cieniu-prawa-duze.jpg',
          'title' => 'W cieniu prawa',
          'description' => 'Galicja, 1909 rok. Mimo złej opinii i niejasnej przeszłości Erik Landecki zostaje przyjęty ',
          'price' => 26
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://static.audioteka.com/pl/images/products/wojciech-chmielarz/wampir-duze.jpg',
          'title' => 'Wampir',
          'description' => 'Mateusz nie miał powodu pragnąć śmierci. Był zwykłym dwudziestolatkiem. Studiował ',
          'price' => 19
        ]);
        $product->save();
    }
}
