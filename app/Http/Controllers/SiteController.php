<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\{
    About, Color, Contact, Fundo, Hero, Pacote, Service, 
    Company, Habilidade, Project, Skill, Termo, Termpb_has_Company, 
    TermsCompany, Visitor
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Http, Mail};
use Jenssegers\Agent\Agent;

class SiteController extends Controller
{
    // Obter os dados da empresa
    private function getCompanyData($companyHash)
    {
        return Company::where('companyhashtoken', $companyHash)->first();
    }

    // Registrar visitante
    public function registerVisitor($company)
    {
        try {
            $userAgent = request()->header('User-Agent');
            $agent = new Agent();
            $agent->setUserAgent($userAgent);

            Visitor::create([
                'ip' => request()->ip(),
                'browser' => $agent->browser(),
                'system' => $agent->platform(),
                'device' => $agent->device(),
                'typedevice' => $agent->isDesktop() ? 'Computador' : ($agent->isPhone() ? 'Telefone' : 'Tablet'),
                'company' => $company->companyname,
            ]);

        } catch (\Throwable $th) {
            logger()->error('Erro ao registrar visitante: ' . $th->getMessage());
        }
    }

    // Página inicial
    public function index($companyHash)
    {
        try {
            session()->forget("companyhashtoken");
            
            $company = $this->getCompanyData($companyHash);

            if (!$company || $company->status !== 'active') {
                return view('disable.App', compact('company'));
            }

            // Coleta de dados
            $this->registerVisitor($company);
            $data = [
                'clients' => Skill::where('elements', 'Clientes')->where('company_id', $company->id)->get(),
                'works' => Skill::where('elements', 'Trabalhos')->where('company_id', $company->id)->get(),
                'premios' => Skill::where('elements', 'Premios')->where('company_id', $company->id)->get(),
                'experience' => Skill::where('elements', 'Experiência')->where('company_id', $company->id)->get(),
                'contact' => Contact::where('company_id', $company->id)->get(),
                'hero' => Hero::where('company_id', $company->id)->get(),
                'skills' => Skill::where('company_id', $company->id)->get(),
                'about' => About::where('company_id', $company->id)->get(),
                'projects' => Project::where('company_id', $company->id)->get(),
                'services' => Service::where('company_id', $company->id)->get(),
                'color' => Color::where('company_id', $company->id)->first(),
                'whatsApp' => Pacote::where('company_id', $company->id)->where('pacote', 'WhatsApp')->first(),
                'shopping' => Pacote::where('company_id', $company->id)->where('pacote', 'Shopping')->first(),
                'phonenumber' => Contact::where('company_id', $company->id)->first(),
                'termsPb' => Termpb_has_Company::where('company_id', $company->id)->with('termsPBs')->first(),
                'terms' => TermsCompany::where('company_id', $company->id)->select('term', 'privacity')->first(),
                'habilitys' => Habilidade::where('company_id', $company->id)->get(),
                'apiArray' => Http::post('http://karamba.ao/api/anuncios', [
                    'key' => 'wRYBszkOguGJDioyqwxcKEliVptArhIPsNLwqrLAomsUGnLoho',
                ])->json(),
                'imageHero' => $this->getFundo($company, 'Hero'),
                'start' => $this->getFundo($company, 'Start'),
                'footer' => $this->getFundo($company, 'Footer'),
                'shoppingImage' => $this->getFundo($company, 'Shopping'),
                'shoppingCartImage' => $this->getFundo($company, 'ShoppingCart'),
                'name' => $company->companyname,
                'companyhashtoken' => $company->companyhashtoken,
                'companynif' => $company->companynif
            ];
            session()->put('companyhashtoken', $companyHash);

            return view('pages.home', $data);
        } catch (\Throwable $th) {
            logger()->error('Erro na página inicial: ' . $th->getMessage());
            return redirect()->back();
        }
    }

    // Obter fundo específico
    private function getFundo($company, $tipo)
    {
        try {
            return Fundo::where('tipo', $tipo)->where('company_id', $company->id)->first();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    // Enviar email
    public function sendEmail(Request $request)
    {
        try {
            Mail::to('pachecobarrosodig3@gmail.com', 'Pacheco Barroso')
            ->send(new SendEmail($request->only('name', 'email', 'subject', 'message')));
    
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    // Gerar senha hash
    public function senha()
    {
        return Hash::make('superadmin');
    }

    // Página de compras
    public function getShopping($companyHash)
    {
        try {
            $company = $this->getCompanyData($companyHash);
            session()->forget("companyhashtoken");
            session()->put("companyhashtoken", $company->companyhashtoken);
            return $this->getShoppingView('pages.shopping.home');
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    // Carrinho de compras
    public function getShoppingCart()
    {
        try {
            return $this->getShoppingView('pages.shopping.shoppingcart');
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    private function getShoppingView($view)
    {
        try {
            $company = $this->getCompanyData(session('companyhashtoken'));
            return view($view, [
                'name' => $company,
                'companyhashtoken' => $company->companyhashtoken,
                'color' => Color::where('company_id', $company->id)->first(),
            ]);
        } catch (\Throwable $th) {
            logger()->error('Erro ao carregar a página de compras: ' . $th->getMessage());
            return redirect()->back();
        }
    }
}