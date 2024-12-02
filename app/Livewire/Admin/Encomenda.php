<?php

namespace App\Livewire\Admin;

use App\Models\company;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Encomenda extends Component
{
    use LivewireAlert;
    public $company, $deliveries, $response, $id,
    $itens, $delivery, $item, $newStatus;
    
    protected $listeners = [
        'changeStatus'=>'changeStatus'
    ];

    public function render()
    {
        return view('livewire.admin.encomenda');
    }

    public function mount()
    {
        try {
            $this->company = company::where("id", auth()->user()->company_id)->first();
            
            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "{$this->company->companytokenapi}",
            ];
    
            //Chamada a API
            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries");

            $this->deliveries = collect(json_decode($response));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateStatus($id, $newStatus)
    {
        try {
            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "{$this->company->companytokenapi}",
            ];

            // Chamada à API para obter a entrega
            $response = Http::withHeaders($headers)
                ->get("https://kytutes.com/api/deliveries?reference=$id");

            $delivery = collect(json_decode($response, true));

            if ($delivery->isEmpty()) {
                $this->alert('error', 'ERRO', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK',
                    'text' => 'Entrega não encontrada'
                ]);
                return;
            }

            // Itera sobre as entregas para atualizar o status
            foreach ($delivery as $item) {
                $estado = $item['delivery']['status'];

                // Verifica se o status atual é 'PENDENTE' antes de atualizar
                if ($estado == 'PENDENTE') {
                    // Atualiza o status
                    $item['delivery']['status'] = $newStatus;

                    // Chamada à API para atualizar o status
                    $updateResponse = Http::withHeaders($headers)
                        ->put("https://kytutes.com/api/deliveries?reference=$id", [
                            'switch' => $newStatus
                        ]);
                        

                    if ($updateResponse->successful()) {
                        $this->alert('success', 
                        'Estado atualizado', [
                            'toast' => false,
                            'position' => 'center',
                            'showConfirmButton' => false,
                            'confirmButtonText' => 'OK',
                        ]);
                    } else {
                        $this->alert('error', 'ERRO', [
                            'toast' => false,
                            'position' => 'center',
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'OK',
                            'text' => 'Falha ao atualizar status'
                        ]);
                    }
                }
            }

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text' => 'Falha ao realizar operação: ' . $th->getMessage()
            ]);
        }
    }

    public function download($id)
    {
        try {
            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "{$this->company->companytokenapi}",
            ];
    
            //Chamada a API
            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries?reference=$id");
            
            $datas = collect(json_decode($response, true));

            foreach ($datas as $item) {
                $receipt = $item['delivery']['receipt'];
            }

            $this->alert('info', '', [
                'toast'=>false,
                'position'=>'center',
                'timer'=>1000,
                'timerProgressBar'=> true,
                'text'=>'A PROCESSAR DOWNLOAD...'
            ]);
            
            return response()->download(storage_path('app/public/recibos/' . $receipt));

        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação' . $th->getMessage()
            ]);
        }
    }

    public function deliveryItens($id)
    {
        try {
            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "{$this->company->companytokenapi}",
            ];
    
            //Chamada a API
            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries?reference=$id");
            
            $this->itens = collect(json_decode($response));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}