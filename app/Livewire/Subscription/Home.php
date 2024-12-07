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

    protected $rules = [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|max:255',
        'password' => 'required|min:6|max:50',
        'confirmpassword' => 'required|same:password',
        'companynif' => 'required|numeric|digits_between:9,14',
        'province' => 'required|string|max:255',
        'municipality' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|regex:/^\d{9,15}$/',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Máx 2MB
        'mylocation' => 'required|string|max:255',
    ];
    
    protected $messages = [
        'name.required' => 'O campo Nome é obrigatório.',
        'lastname.required' => 'O campo Sobrenome é obrigatório.',
        'email.required' => 'O campo E-mail é obrigatório.',
        'email.email' => 'Insira um endereço de e-mail válido.',
        'email.unique' => 'Já existe uma conta registrada com este e-mail.',
        'password.required' => 'O campo Senha é obrigatório.',
        'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        'password.max' => 'A senha não pode exceder 50 caracteres.',
        'confirmpassword.required' => 'A confirmação da senha é obrigatória.',
        'confirmpassword.same' => 'A confirmação da senha deve ser igual à senha.',
        'companynif.required' => 'O campo NIF é obrigatório.',
        'companynif.numeric' => 'O NIF deve conter apenas números.',
        'companynif.digits_between' => 'O NIF deve ter entre 9 e 14 dígitos.',
        'province.required' => 'O campo Província é obrigatório.',
        'municipality.required' => 'O campo Município é obrigatório.',
        'address.required' => 'O campo Endereço é obrigatório.',
        'phone.required' => 'O campo Telefone é obrigatório.',
        'phone.regex' => 'O telefone deve conter apenas números e ter entre 9 e 15 dígitos.',
        'image.required' => 'O envio de uma imagem é obrigatório.',
        'image.image' => 'O arquivo enviado deve ser uma imagem.',
        'image.mimes' => 'A imagem deve estar no formato jpeg, png, jpg ou gif.',
        'mylocation.required' => 'O campo Localização é obrigatório.',
    ];
    
    public function render()
    {
        return view('livewire.subscription.home',
        ['locationMap' => $this->getAllLocations()]
        )->layout("layouts.subscription.app");
    }

    public function createAccountSite()
    {
        
        $this->validate($this->rules, $this->messages);
        DB::beginTransaction();
        
        try {
            // Manipulação da imagem
            $fileName = null;
            if ($this->image != null && $this->image instanceof \Illuminate\Http\UploadedFile) {
                $fileName = uniqid() . "." . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs("public/company", $fileName);
            }

            // Criação de token único para a empresa
            $tokenCompany = $this->name . rand(2000, 3000);

            // Criar registro da empresa
            $company = new company();
            $company->companyname = $this->name;
            $company->companyemail = $this->email;
            $company->companynif = $this->companynif;
            $company->companybusiness = "Artes";
            $company->companyhashtoken = $tokenCompany;
            $company->save();

            // Criar usuário administrador
            $user = new User();
            $user->name = $this->name . " " . $this->lastname;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->role = "Administrador";
            $user->company_id = $company->id;
            $user->save();

            // Informações para a API kytutes
            $infoCompany = [
                "name" => $this->name . " " . $this->lastname,
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

            // Informações para a API Xzero
            $infoXzero = [
                "companyname" => $this->name . " " . $this->lastname,
                "companynif" => $this->companynif,
                "companyregime" => "Exclusão",
                "companyphone" => $this->phone,
                "companyalternativephone" => 999999999,
                "companyemail" => $this->email,
                "companyprovince" => $this->province,
                "companymunicipality" => $this->municipality,
                "companyaddress" => $this->address,
                "password" => $this->password,
                "companycountry" => "AOA"
            ];

            // Chamada às APIs externas
            $response = Http::withHeaders($this->getHeaders())
            ->post("https://kytutes.com/api/create/company", $infoCompany)
            ->json();

            $xzeroResponse = Http::withHeaders($this->getHeaders())
            ->post("https://xzero.ao/api/create/account", $infoXzero)
            ->json();

            // Atualizar tokens da empresa
            $company->companytokenapi = $response['token'] ?? null;
            $company->token_xzero = $xzeroResponse['apiToken'] ?? null;
            $company->update();

            // Disparar evento Registered
            event(new Registered($user));

            //Limpar formulário
            $this->clearForm();
            DB::commit();

            return redirect()->route("site.status.account");
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'ERRO', [
                'toast' => false,
                'position' => 'center',
                'timer' => '1500',
                'text' => 'Ocorreu um erro'
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