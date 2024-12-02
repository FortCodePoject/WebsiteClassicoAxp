<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\{About, Color, contact, Fundo, hero, pacote, Service,
    company as ModelsCompany, Habilidade, Project, Skill, Termo, Termpb_has_Company, TermsCompany, visitor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class SiteController extends Controller
{
    //pegar a conta da empresa
    public function getCompany($company)
    {
        return ModelsCompany::where('companyhashtoken', $company)->first();
    }

    public function getVisitor($companyhash)
    {
        try {
            // Capturar informações da requisição
            $userAgent = request()->header('User-Agent');

            // Usar a biblioteca Jenssegers/Agent para analisar o user agent
            $agent = new Agent();
            $agent->setUserAgent($userAgent);

            //salvar os dados no banco
            $visitors = new visitor();

            $visitors->ip = request()->ip();
            $visitors->browser = $agent->browser();
            $visitors->system = $agent->platform();
            $visitors->device = $agent->device();
            
            if ($agent->isDesktop()) {
                $visitors->typedevice = "Computador";
            }if ($agent->isPhone()) {
                $visitors->typedevice = "Telefone";
            }if ($agent->isTablet()) {
                $visitors->typedevice = "Tablet";
            }
            
            $visitors->company = $companyhash->companyname;
            
            $visitors->save();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function index($company)
    {
        try {
            $data = $this->getCompany($company);
            if ($data && $data->status === 'active') {
                
                $contact = Contact::where("company_id", $data->id)->get();
                $skills = Skill::where("company_id", $data->id)->get();
                $about = About::where("company_id", $data->id)->get();
                $services = Service::where("company_id", $data->id)->get();
                $projects = Project::where("company_id", $data->id)->get();
                $name = ModelsCompany::where("companyhashtoken", $company)->first();
                $clients = Skill::where("elements", "Clientes")
                            ->where("company_id", $data->id)->get();
                $works = Skill::where("elements", "Trabalhos")
                            ->where("company_id", $data->id)->get();
                $premios = Skill::where("elements", "Premios")
                            ->where("company_id", $data->id)->get();
                $experience = Skill::where("elements", "Experiência")
                            ->where("company_id", $data->id)->get();
                $hero = Hero::where("company_id", $data->id)->get();
                $color = Color::where("company_id", $data->id)->first();
        
                $WhatsApp = Pacote::where("company_id", $data->id)->where("pacote", "WhatsApp")->first();
                $packges = Pacote::where("company_id", $data->id)->where("pacote", "Shopping")->first();
                $phonenumber = Contact::where("company_id", $data->id)->first();
                $habilitys = Habilidade::where("company_id", $data->id)->get();
    
                $api = Http::post("http://karamba.ao/api/anuncios", ["key" => "wRYBszkOguGJDioyqwxcKEliVptArhIPsNLwqrLAomsUGnLoho"]);
                $apiArray = $api->json();
    
                $termsPb = Termpb_has_Company::where("company_id", $data->id)->with('termsPBs')->first();

                $termos = TermsCompany::where("company_id", $data->id)
                ->select("term", "privacity")->first();

                $companyhash = ModelsCompany::where("companyhashtoken", $company)->first();
                //capturar dados de acesso
                $this->getVisitor($companyhash);
                session()->put("companyhashtoken", $companyhash->companyhashtoken);
                return view("pages.home", [
                    "clients" => $clients, 
                    "works" => $works, 
                    "premios" => $premios, 
                    "experience" => $experience, 
                    "contact" => $contact, 
                    "hero" => $hero, 
                    "skills" => $skills, 
                    "about" => $about,
                    "projects" => $projects,
                    "services" => $services,
                    "name" => $name,
                    "companies" => $termsPb,
                    "color" => $color,
                    "whatsApp" => $WhatsApp,
                    "packges" => $packges,
                    "phonenumber" => $phonenumber,
                    "data" => $data,
                    "termos" => $termos,
                    "apiArray" => $apiArray,
                    "habilitys" => $habilitys,
                    "imageHero" => $this->imageHero($company),
                    "start" => $this->start($company),
                    "footer" => $this->footer($company),
                    "shopping" => $this->imageShopping($company),
                    "shoppingCart" => $this->imageShoppingCart($company)
                ]);
            } else {
                $name = ModelsCompany::where("companyhashtoken", $company)->first();
                return view("disable.App", compact("name"));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function imageHero($company){
        $data = ModelsCompany::where("companyhashtoken", $company)->first();
        $imageHero = Fundo::where("tipo", "Hero")
        ->where("company_id", $data->id)->first();
        return $imageHero;
    }

    public function imageShopping($company){
        $data = ModelsCompany::where("companyhashtoken", $company)->first();
        $imageHero = Fundo::where("tipo", "Shopping")
        ->where("company_id", $data->id)->first();
        return $imageHero;
    }

    public function imageShoppingCart($company){
        $data = ModelsCompany::where("companyhashtoken", $company)->first();
        $imageHero = Fundo::where("tipo", "ShoppingCart")
        ->where("company_id", $data->id)->first();
        return $imageHero;
    }

    public function start($company){
        $data = ModelsCompany::where("companyhashtoken", $company)->first();
        $start = Fundo::where("tipo", "Start")
        ->where("company_id", $data->id)->first();
        return $start;
    }

    public function footer($company){
        $data = ModelsCompany::where("companyhashtoken", $company)->first();
        $footer = Fundo::where("tipo", "Footer")
        ->where("company_id", $data->id)->first();
        return $footer;
    }

    public function sendEmail(Request $request){
        Mail::to("pachecobarrosodig3@gmail.com", "Pacheco Barroso")->send(new SendEmail([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
            "from" => $request->email,
    ]));
       return redirect()->back();
    }

    public function senha(){
        return Hash::make("superadmin");
    }

    public function getShopping()
    {
        try {
            $company = $this->getCompany(session("companyhashtoken"));
            $color = Color::where("company_id", $company->id)->first();
            $packges = Pacote::where("company_id", $company->id)->where("pacote", "Shopping")->first();

            return view("pages.shopping.home", 
                [
                    "name" => $company,
                    "color" => $color,
                    "packges" => $packges
                ]
            );
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function getShoppingcart()
    {
        try {
            //code...
            $company = $this->getCompany(session("companyhashtoken"));
            $color = Color::where("company_id", $company->id)->first();
            $packges = Pacote::where("company_id", $company->id)->where("pacote", "Shopping")->first();

            return view("pages.shopping.shoppingcart", [
                "color" => $color,
                "name" => $company,
                "packges" => $packges
            ]);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}