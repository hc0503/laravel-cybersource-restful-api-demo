<?php

use Illuminate\Database\Seeder;
use App\Models\Disclaimer;

class DisclaimersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disclaimer::truncate();
        
        factory(Disclaimer::class)->create([
            'content' => '<h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;">Website Disclaimer</h5><h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;"><p style="font-size: 14.304px;">Magazine Heaven Direct Limited have taken every care to ensure the information contained on this website is correct, no responsibility is implied or accepted for any errors.<br>Magazine Heaven Direct Limited assumes no liability for any loss, damage or expense from errors or omissions in the information or materials available in the website, whether arising in contract, tort or otherwise.<br>Magazine Heaven Direct Limited makes no warranty that its website will be uninterrupted or free of errors or that any defects can be corrected.<br>Accessing the Magazine Heaven Direct Limited website and any downloading of material either, written, graphic or otherwise is done entirely at the user’s risk. The user will be solely responsible for any resulting damage to computers or software and/or resulting in the loss of any data contained.<br>Magazine Heaven Direct Limited makes no warranty as to the accuracy, content or legality of any linked site or from any subsequent links from its site.</p></h5><h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;">WEBSITE COPYRIGHT STATEMENT</h5><h5 style="font-family: Ubuntu, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;"><p style="font-size: 14.304px;">Magazine Heaven Direct Limited Copyright<br>Materials, written, graphic or otherwise that are contained within the Magazine Heaven Direct Limited website are protected by copyright law. No part of written text or graphics on this website may be reproduced or transmitted in any form or by any means including electronic or mechanical or otherwise, including by photocopying, recording, fax transmission or using any storage and retrieval systems without the permission of Magazine Heaven Direct Limited. No content on this website may be distributed for any commercial purpose whatsoever.<br>Trademarks<br>Any and all trademarks carried within the Magazine Heaven Direct Limited website are the property of their respective owners.</p></h5>',
        ]);
    }
}
