<?php

namespace App\Http\Controllers;

use App\Models\{About,Color,contact, documentation, Fundo,hero,Project,Service,Skill, User};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index(){
        $name = About::where("company_id", auth()->user()->company->id)->get();
        return view("sbadmin.home", compact("name"));
    }

    public function heroview(){
        $company_id = auth()->user()->company->id;
        $datas = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "INICIAL")->get();
        $hero = hero::where("company_id", $company_id)->get();
        return view("sbadmin.section1", compact(
            "hero", 
            "datas",
        ));
    }

    public function registerdatas(Request $request){
        try {
            $data = new hero();
                
            $company_id = auth()->user()->company->id;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->company_id = $company_id;
       
            if ($image = $request->file('image')) {
                $destinationPath = 'image/';
                $profileImage = rand(2000, 3000) . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $data->img = $profileImage;
            }

            $data->save();
            return redirect()->back()->with('success', 'Informações do Hero Registrados');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Não é possivel");
        }
    }

    public function edit($id){
        $data = hero::find($id);
        $layout = "admin.widgets.users.edit";

        return view($layout, ["data" => $data]);
    }

    public function update(Request $request, $id){
        $data = hero::find($id);

        $data->title = $request->title;
        $data->description = $request->description;

        if($request->hasFile("image")){
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = "hero" . "." . $extension;
            $file->move("image/", $filename);
            $data->img = $filename;
        }

        $data->update();
        return redirect()->back()->with("success", "Dados Actualizados");
    }

    //Imformações das caracteristicas do site...
    public function infowhy(){
        $company_id = auth()->user()->company->id;
        $projecto = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "PROJECTOS")->get();
        $infos = Project::where("company_id", $company_id)->get();
        return view("sbadmin.projects", compact("infos", "projecto"));
    }

    public function editwhy($id){
        $data = Project::find($id);
        $layout = "admin.widgets.users.editinfo";

        return view($layout, ["data" => $data]);
    }

    public function actualizar(Request $request, $id){
        $data = Project::find($id);

        $data->title = $request->title;

        if($request->hasFile("image")){
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = date("YmdHis") . "." . $extension;
            $file->move("image/", $filename);
            $data->image = $filename;
        }

        $data->update();
        
        return redirect()->back()->with("success", "Projecto Actualizado");
    }

    public function storeinfowhy(Request $request){
        try {
            //code...
        $company_id = auth()->user()->company->id;
        $data = new Project();

        $data->title = $request->title;
        $data->company_id = $company_id;
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = "hero" . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data->image = $profileImage;
        }

        $data->save();

            return redirect()->back()->with("success", "Projecto Adicionado");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Erro não é possivel");
        }
    }

    //Informações do footer Painel Admin
    public function footer(){
        $company_id = auth()->user()->company->id;
        $rodape = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "RODAPE")->get();
        $footer = contact::where("company_id", $company_id)->get();
        return view("sbadmin.footer", compact("footer", "rodape"));
    }

    public function contactStore(Request $request){
        $company_id = auth()->user()->company->id;
        $data = new contact();

        $data->telefone = $request->telefone;
        $data->endereco = $request->endereco;
        $data->email = $request->email;
        $data->atendimento = $request->atendimento;
        $data->company_id = $company_id;

        $data->save();

        return redirect()->back()->with("success", "Footer Adicionado");
        
    }

    public function editContact($id){
        $contact = contact::find($id);
        return view("admin.widgets.users.editcontact", compact("contact"));
    }

    public function actualizarContact(Request $request, $id){
        contact::where(["id" => $id])->update([
            "telefone" => $request->telefone,
            "endereco" => $request->endereco,
            "atendimento" => $request->atendimento,
            "email" => $request->email,
            "id" => $request->id,
        ]);
        return redirect()->back()->with("success", "Footer actualizado");
    }

    //Infromações sobre os detalhes
    public function detailview(){
        $skills = Skill::all();
        $element = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "ELEMENTOS")->get();

        return view("sbadmin.skill", compact("skills", "element"));
    }

    public function storeDetail(Request $request){
        try {           
          $company_id = auth()->user()->company->id;
          $skills = new Skill();
 
          $skills->elements = $request->elements;
          $skills->level = $request->level;
          $skills->company_id = $company_id;
 
          $skills->save();
          return redirect()->back()->with("success", "Elemento Adicionado");
        } catch (\Throwable $th) {
          dd($th->getMessage());
          return redirect()->back()->with("error", "Não Pode adicionar");
        }
    }
     
    public function actualizarDetalhes(Request $request, $id){
        Skill::where(["id" => $id])->update([
            "level" => $request->level,
            "id" => $request->id,
        ]);
        return redirect()->back()->with("success", "Elemento actualizado");
    }

    //Imformações sobre o site OU Sobre
    public function about(){
        $company_id = auth()->user()->company->id;
        $databout = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "SOBRE")->get();
        $data = About::where("company_id", $company_id)->get();
        return view("sbadmin.about", compact("databout", "data"));
    }

    public function storeAbout(Request $request){
        try {
            $company_id = auth()->user()->company->id;
            $data = new About();

            $data->p1 = $request->p1;
            $data->p2 = $request->p2;
            $data->nome = $request->nome;
            $data->perfil = $request->perfil;
            $data->company_id = $company_id;
            $data->save();
            
            return redirect()->back()->with("success", "Sobre Cadastrado");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Erro ao cadastrar");
        }
    }

    public function actualizarAbout(Request $request, $id){
        About::where(["id" => $id])->update([
            "p1" => $request->p1,
            "p2" => $request->p2,
            "nome" => $request->nome,
            "perfil" => $request->perfil,
            "id" => $request->id,
        ]);
        return redirect()->back()->with("success", "Sobre Actualizado");
    }

    //services
    public function viewservice(){
        $company_id = auth()->user()->company->id;
        $service = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "SERVIÇOS")->get();
        $data = Service::where("company_id", $company_id)->get();
        return view("sbadmin.service", compact("data", "service"));
    }

    public function storeservice(Request $request){
        try {
            //code...
            $company_id = auth()->user()->company->id;

            $services = new Service();

            $services->title = $request->title;
            $services->description = $request->description;
            $services->company_id = $company_id;

            $services->save();

            return redirect()->back()->with("success", "Serviço Cadastrado");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Não é possivel");

        }
    }

    public function actualizarservice(Request $request, $id){
        $company_id = auth()->user()->company->id;
        Service::where(["id" => $id])->update([
            "company_id" => $company_id,
            "title" => $request->title,
            "description" => $request->description,
            "id" => $request->id
        ]);

        return redirect()->back()->with("success" , "Serviço actualizado");
    }

    //change color for the website
    public function colorview(){
        $company_id = auth()->user()->company->id;
        $color = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "CORES")->get();
        $colors = Color::where("company_id", $company_id)->get();
        return view("sbadmin.color", compact("colors", "color"));
    }

    public function storecolor(Request $request){
        try {
            $company_id = auth()->user()->company->id;
            $countSelectColor = Color::where("company_id", $company_id)->count();

            if (isset($countSelectColor) and $countSelectColor > 0) {
                $selectColor = Color::get();
                $selectColor->codigo = $request->codigo;
                $selectColor->letra = $request->letra;
                $selectColor->save();
            } else {
                $color = new Color();
                $color->codigo = $request->codigo;
                $color->letra = $request->letra;
                $color->company_id = $company_id;
                $color->save();
            }
            return redirect()->back()->with("success", "Cores adicionadas");

        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Não é possivel"); 
        }
    }

    //imagens de funddo
    public function imagebackground()
    {
        $company_id = auth()->user()->company->id;
        $image = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "IMAGEM")->get();
        $fundo = Fundo::where("company_id", $company_id)->get();
        return view("sbadmin.fundo", compact("fundo", "image"));
    }

    public function imageactualizar(Request $request)
    {
        $fundo = Fundo::find($request->id);

        if ($request->hasFile("image")) {
            //$destinationPath = "public/image";
            $image = $request->file("image");
            //$imageName = $image->getClientOriginalName(); 
            $path = $request->file("image")->store("uploads/fundo"); //podes meter uploads/retangulo ou quadrado

            $fundo->image = $path;
        }
        $fundo->save();
        return redirect()->back()->with("success", "Imagem actualizada");

    }

    public function imagebackgroundstore(Request $request){
        try {
            $company_id = auth()->user()->company->id;
            $fundo = new Fundo();

            $fundo->tipo = $request->tipo;
            $fundo->company_id = $company_id;

            if ($request->hasFile("image")) {
                //$destinationPath = "public/image";
                $image = $request->file("image");
                //$imageName = $image->getClientOriginalName(); 
                $path = $request->file("image")->store("uploads/fundo"); //podes meter uploads/retangulo ou quadrado
    
                $fundo->image = $path;
            }
            $fundo->save();
            return redirect()->back()->with("success", "Imagem Inserida");
        } catch (\Throwable $th) {
            return redirect()->back()->with("success", "Imagem Não Inserida");
        }
    }

    public function profileUser(){
        $account = documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "CONTA")->get();
        return view("sbadmin.profile.index", compact("account"));
    }

    public function updateProfile(Request $request){
        try {
           $credential = User::find($request->id);

           $credential->name = $request->name;
           $credential->email = $request->email;
           $credential->password = bcrypt($request->password);

           $credential->save();
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}