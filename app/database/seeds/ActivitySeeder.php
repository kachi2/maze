<?php

use Illuminate\Database\Seeder;
use App\AgentActivity;
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            ['agent_id' => 9, 'login_ip' => '195.198.1.1', 'last_login'=>now(), 'browser' => 'ChromeOS'],
            ['agent_id' => 9, 'login_ip' => '195.198.1.1', 'last_login'=>now(), 'browser' => 'ChromeOS'],
            ['agent_id' => 9, 'login_ip' => '195.198.1.1', 'last_login'=>now(), 'browser' => 'ChromeOS'],
            ['agent_id' => 9, 'login_ip' => '195.198.1.1', 'last_login'=>now(), 'browser' => 'ChromeOS'],
            ['agent_id' => 9, 'login_ip' => '195.198.1.1', 'last_login'=>now(), 'browser' => 'ChromeOS'],
        ];

        foreach($data as $dat){
            AgentActivity::create($dat);
        }
    }
}
