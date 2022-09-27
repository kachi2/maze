<?php

use Illuminate\Database\Seeder;
use App\Payment;
class AgentPayment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['agent_id' => 9, 'ref' => 'woKJKdddkkas12', 'amount' => '500', 'status' => 'pending'],
            ['agent_id' => 9, 'ref' => 'woKJKksskkas12', 'amount' => '600', 'status' => 'success'],
            ['agent_id' => 9, 'ref' => 'woKJKkghgkkas12', 'amount' => '900', 'status' => 'pending'],
            ['agent_id' => 9, 'ref' => 'woKJKkdskkas12', 'amount' => '510', 'status' => 'success'],
            ['agent_id' => 9, 'ref' => 'woKJKk445kas12', 'amount' => '550', 'status' => 'success'],
            ['agent_id' => 9, 'ref' => 'woKJKka777kas12', 'amount' => '700', 'status' => 'pending'],
            ['agent_id' => 9, 'ref' => 'woKJKka232as12', 'amount' => '340', 'status' => 'pending'],
            ['agent_id' => 9, 'ref' => 'woKJKka656as12', 'amount' => '770', 'status' => 'pending'],
        ];
        foreach($data as $dat){
        Payment::create($dat);
        }
    }
}
