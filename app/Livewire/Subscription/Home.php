<?php

namespace App\Livewire\Subscription;

use App\Models\{User, company};
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\{DB, Hash, Http};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Component;

class Home extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $name, $infoCompanyToken, $password, $company, 
    $lastname, $companynif, $companybusiness, 
    $email, $confirmpassword, $image, $province, 
    $municipality, $address, $phone, $mylocation;

    protected $rules =[
        'name'=>'required',
        'lastname'=>'required',
        'email'=>'required|unique:users,email|email',
        'password'=>'required',
        'confirmpassword'=>'required|same:password',
        'companynif'=>'required',
        'companybusiness'=>'required',
        'province'=>'required',
        'municipality'=>'required',
        'address'=>'required',
        'phone'=>'required',
        'image'=>'required',
    ];

    protected $messages =[
        'name.required'=>'Obrigatório',
        'lastname.required'=>'Obrigatório',
        'email.required'=>'Obrigatório',
        'companynif.required'=>'Obrigatório',
        'companybusiness.required'=>'Obrigatório',
        'email.unique'=>'Já existe uma conta com este email',
        'password.required'=>'Obrigatório',
        'confirmpassword.required' => 'A confirmação da senha é obrigatória.',
        'confirmpassword.same' => 'A confirmação da senha deve ser igual à senha.',
        'province.required'=>'Obrigatório',
        'municipality.required'=>'Obrigatório',
        'address.required'=>'Obrigatório',
        'phone.required'=>'Obrigatório',
        'image.required'=>'Obrigatório',
    ];

    public function render()
    {
        return view('livewire.subscription.home',
        ['locationMap' => $this->getAllLocations()]
        )->layout("layouts.subscription.app");
    }

    public function createAccountSite()
    {
        DB::beginTransaction();
        //$this->validate($this->rules,$this->messages);
            try {
                
                //manipulation image
                if ($this->image != null && $this->image instanceof \Illuminate\Http\UploadedFile) {
                    $fileName = uniqid() . "." . $this->image->getClientOriginalExtension();
                    $this->image->storeAs("public/company", $fileName);
                }
                // Create token for company
                $tokenCompany = $this->name. rand(2000, 3000);

                $company = new company();

                $company->companyname = $this->name;
                $company->companyemail = $this->email;
                $company->companynif = $this->companynif;
                $company->companybusiness = "Artes";
                $company->companyhashtoken = $tokenCompany;
                $company->save();

                $user = new User();
                $user->name = $this->name . " " .$this->lastname;
                $user->email = $this->email;
                $user->password = Hash::make($this->password); 
                $user->role = "Administrador";
                $user->company_id = $company->id;
                $user->save();

                $infoCompany = [
                    "name" => $this->name . " ". $this->lastname,
                    "nif" => $this->companynif,
                    "phone" => $this->phone,
                    "email" => $this->email,
                    "province" => $this->province,
                    "municipality" => $this->municipality,
                    "address" => $this->address,
                    "image" => $fileName,
                    "password" => $this->password,
                    "myLocation" => $this->mylocation,
                    "isAxp" => 1
                ];

                 $infoXzero = [
                    "companyname"=>$this->name . " ". $this->lastname,
                    "companynif" => $this->companynif,
                    "companyregime"=> "Exclusão",
                    "companyphone"=> $this->phone,
                    "companyalternativephone"=> 999999999,
                    "companyemail"=> $this->email,
                    "companyprovince"=> $this->province,
                    "companymunicipality"=> $this->municipality,
                    "companyaddress"=> $this->address,
                    "password" => $this->password,
                    "companycountry" => "AOA"
                ];

                $xzeroResponse = Http::withHeaders($this->getHeaders())
                ->post("https://xzero.ao/api/create/account", $infoXzero)
                ->json();
    
                //Chamada a API
                $response = Http::withHeaders($this->getHeaders())
                ->post("https://kytutes.com/api/create/company", $infoCompany)
                ->json();

                $company->companytokenapi = $response['token'] ?? null;
                $company->token_xzero = $xzeroResponse['apiToken'] ?? null;
                $company->update();

                event(new Registered($user));
                $this->clearForm();

                DB::commit();

                return redirect()->route("site.status.account");

            } catch (\Throwable $th) {
                DB::rollBack();
                $this->alert('error', 'ERRO', [
                    'toast'=>false,
                    'position'=>'center',
                    'timer' => '1500',
                    'text'=>'Ocorreu um erro'
                ]);
            }
    }

    public function clearForm()
    {
        $this->name = '';
        $this->lastname = '';
        $this->email = '';
        $this->password = '';
        $this->confirmpassword = '';
        $this->companybusiness = '';
        $this->companynif = '';
        $this->image = '';
    }

    public function getHeaders()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ];
    }

    public function getAllLocations()
    {
        try {

            $response = Http::withHeaders([
                    "Accept" => "application/json",
                    "Content-Type" => "application/json",
                ])->get("https://kytutes.com/api/location/map")->json();

            if ($response != null) {
                return $response;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}