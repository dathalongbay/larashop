<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
            'logo', 'favicon', 'site_title', 'header_msg_1', 'header_msg_2',
            'header_msg_3', 'facebook', 'twiter', 'instagram', 'youtube', 'header_menu',
            'slider_homepage', 'process_title', 'process_step_1', 'process_step_1_desc',
            'process_step_2', 'process_step_2_desc', 'process_step_3', 'process_step_3_desc',
            'footer_menu' , 'contact_address', 'contact_mail', 'contact_phone', 'flicker', 'footer_desc',
            'copyright'
        );

        foreach ($settings as $setting) {
            //
            DB::table('settings')->insert([
                'name' => $setting,
                'value' => '',
                'default' => '',
            ]);
        }

    }
}
