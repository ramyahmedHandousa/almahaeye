<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 10 // 11 // 12 // 13 / 6 / 7

      $product =   $this->createProducts('نظارة للرؤية الليلية',10);
      $this->uploadImage($product);
      $this->uploadImageTwo($product);
      $this->uploadImageThree($product);
//      $product =   $this->createProducts('نظارة أمريكي',12);
//      $this->uploadImage($product);
//      $product =   $this->createProducts('نظارة حفظ نظر',13);
//      $this->uploadImage($product);
//      $product =   $this->createProducts('نظارة للمذاكرة',6);
//      $this->uploadImage($product);
//      $product =   $this->createProducts('نظارة معدن للجري',7);
//      $this->uploadImage($product);
//      $product =   $this->createProducts('نظارة بلاستيك للكورة',10);
//      $this->uploadImage($product);

    }

    private function uploadImage($product)
    {
        $url = 'https://images.ctfassets.net/u4vv676b8z52/7gDQHxOn1ciYucQl4txQdF/1c5a463ff509944441a64b8d975d90dc/Hero_Article_MensEyeglasses-Most-Durable-compressor.jpg?fm=jpg&q=80';
        $product->addMediaFromUrl($url)->toMediaCollection('master_image');
    }
    private function uploadImageTwo($product)
    {
        $url = 'https://images.ctfassets.net/u4vv676b8z52/5XVRz3RmxRqyB7dwDasR6u/a55c811525167a4eab50d014e59250d2/blue-light-glasses-hero-678x446.jpg?fm=jpg&q=80';
        $product->addMediaFromUrl($url)->toMediaCollection('master_image');
    }
    private function uploadImageThree($product)
    {
        $url = 'https://i.pinimg.com/originals/3e/b1/c8/3eb1c84f877e49134edb126bf739c73f.jpg';
        $product->addMediaFromUrl($url)->toMediaCollection('master_image');
    }

    private function createProducts($name,$categoryId)
    {
        $product = new Product();
        $product->user_id               = 1;
        $product->category_id           = $categoryId;
        $product->brand_id              = rand(1,2);
        $product->frame_material_id     = rand(3,4);
        $product->age_id                = rand(2,3);
        $product->frame_shap_id         = rand(1,2);
        $product->product_type_id       = rand(3,4);
        $product->additional_data       = [
            'frame_height'  => rand(1,100),
            'temple_length' => rand(2,5),
            'lens_width'    =>  rand(1,50),
            'nose_bridge'   =>  rand(1,10),
        ];
        $product->price                 = rand(1,1000);
        $product->quantity              =  rand(1,10);
        $product->{'name:ar'}           = $name;
        $product->{'name:en'}           = ' description ar testing ';
        $product->{'description:ar'}    = $name . '  وصف ';
        $product->{'description:en'}    = ' description en testing ';
        $product->save();
        return $product;
    }


}
