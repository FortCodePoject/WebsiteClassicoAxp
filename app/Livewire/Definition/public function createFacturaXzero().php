public function createFacturaXzero()
{
    try {
        //Acesso a API com um token
        $items = [];
        if (count(CartFacade::getContent()) > 0) {
            foreach (CartFacade::getContent() as $key => $item) {
                array_push($items, [
                    "price" => $item->price,
                    "quantity" => $item->quantity,
                    "description" => $item->item,
                    "tax" => 0,
                    "discount" => 0,
                    "retension" => 0,
                    "productType" => "Unidade",
                    "exemption_code" => 0
                ]);
            }
        }

        //code...
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ',
        ])->post('https://xzero.ao/api/invoice/create', [

            "isBackoffice" => '0',
            "type" => 'FR',
            "customerName" => $this->name,
            "customerPhone" => $this->phone,
            "taxpayerNumber" => $this->taxPayer,
            "customerEmail" => $this->email,
            "customerAddress" => $this->province ?? "Luanda,Angola",
            "paymentType" => $this->paymentType ?? '',
            "items" => $items

        ])->json();

        return $response;
    } catch (\Throwable $th) {
        //throw $th;
    }
}

public function verifyStockWithProvider()
{
    try {
        $company = Company::where("companyhashtoken", session("companyhashtoken"))
            ->select("id")
            ->first();

        if ($company) {
            if (count(CartFacade::getContent()) > 0) {
                foreach (CartFacade::getContent() as $key => $item) {
                    # Adicionar items para verificação de existencia com Artista

                    VerifyStock::create([
                        "product" => $item->name,
                        "price" => $item->price,
                        "quantity" => $item->quantity,
                        "ipaddress" => $_SERVER['REMOTE_ADDR'],
                        "company_id" => $company->id,
                        "image" => $item->attributes["image"] ?? Null,
                    ]);
                }
            }
        }


        $this->dispatch("isVerifyed");
    } catch (\Throwable $th) {

        $this->alert('error', 'ERRO', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK',
            'text' => 'Falha ao realizar operação'
        ]);
    }
}

/** 
* VERIFICAR SE O ARTISTA CONFIRMOU A EXISTENCIA DOS QUADROS
*/

public function isProductVerifyed()
{
    try {
        $company = Company::where("companyhashtoken", session("companyhashtoken"))
            ->select("id")
            ->first();

        if ($company) {
            $data =  VerifyStock::where("ipaddress", $_SERVER['REMOTE_ADDR'])
                ->where("company_id", $company->id)
                ->where("status", 1)
                ->count();

            if ($data <= 0) {
                return 0;
            }
        }
    } catch (\Throwable $th) {
        $this->alert('error', 'ERRO', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK',
            'text' => 'Falha ao realizar operação'
        ]);
    }
}

public function clearProduct()
{
    try {
        $company = Company::where("companyhashtoken", session("companyhashtoken"))
            ->select("id")
            ->first();

        if ($company) {
                VerifyStock::where("ipaddress", $_SERVER['REMOTE_ADDR'])
                ->where("company_id", $company->id)
                ->delete();
        }
    } catch (\Throwable $th) {
        $this->alert('error', 'ERRO', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK',
            'text' => 'Falha ao realizar operação'
        ]);
    }
}

public function Verifyed()
{
        try {
    CartFacade::clear();

    $company = Company::where("companyhashtoken", session("companyhashtoken"))
        ->select("id")
        ->first();

    if ($company) {
        $data =  VerifyStock::where("ipaddress", $_SERVER['REMOTE_ADDR'])
            ->where("company_id", $company->id)
            ->where("status", 1)
            ->get();

        if ($data->count() > 0) {

            foreach ($data as $key => $value) {
                CartFacade::add(array(
                    'id' => $value->id,
                    'name' => $value->product,
                    'price' => ($value->availablePrice != null) ? $value->availablePrice : $value->price,
                    'quantity' => ($value->availableQuantity != null) ? $value->availableQuantity : $value->quantity,
                    'attributes' => array(
                        'image' => $value->image ?? "",
                    )
                ));
            }

            
        }
    }
    } catch (\Throwable $th) {
        $this->alert('error', 'ERRO', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK',
            'text' => 'Falha ao realizar operação'
        ]);
    }
}