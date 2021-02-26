<?php

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::truncate();
        
        factory(AboutUs::class)->create([
            'content' => '<h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;"><p style="font-size: 14.304px;">Magazine Heaven Direct is the specialist partner for enterprising, independent magazine publishers.</p><p style="font-size: 14.304px;">Whether you are an existing magazine or yet to launch, we will help you achieve your circulation goals and provide a range of specialist, tailored services that will really benefit your business.</p><p style="font-size: 14.304px;">We pride ourselves on the quality and range of our services and deliver unique, creative solutions for publishers who need to get their product to market or expand and develop an existing market or distribution channel, either in the UK or Internationally.</p><p style="font-size: 14.304px;">Magazine Heaven Direct is affiliated with Magazine Heaven, The UK’s largest Magazine Retail store, stocking more 3600 publications, with an impressive e-commerce store and offering worldwide single copy sales direct to consumer and subscriptions.</p><p style="font-size: 14.304px;">Magazine Heaven also curates and sells back issues for many publishers and offers mailing services and bulk deliveries.</p><a href="https://www.magazineheavendirect.com/" target="__blank" style="background-color: rgb(255, 255, 255); font-size: 14.304px;">Magazine Heaven Direct</a><span style="font-size: 14.304px;"></span><br style="font-size: 14.304px;"><a href="https://www.magazineheaven.com/" target="__blank" style="background-color: rgb(255, 255, 255); font-size: 14.304px;">Magazine Heaven</a><br></h5>',
        ]);
    }
}
