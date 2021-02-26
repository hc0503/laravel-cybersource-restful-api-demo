<?php

use Illuminate\Database\Seeder;
use App\Models\ContactUs;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::truncate();
        
        factory(ContactUs::class)->create([
            'content' => '<h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;">New Business &amp; Distribution enquiries:</h5><h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;"><p style="font-size: 14.304px;">Steve Hobbs&nbsp;<a href="mailto:shcirculation@ntlworld.com" target="__blank">shcirculation@ntlworld.com</a>&nbsp;/ Tel +44 (0)2392 787 970</p></h5><h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;">Direct Sales:</h5><h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;"><p style="font-size: 14.304px;">Bill Palmer&nbsp;<a href="mailto:bill@magazineheaven.com" target="__blank">bill@magazineheaven.com</a>&nbsp;/ Tel +44 (0)7712 862 582</p></h5>',
        ]);
    }
}
