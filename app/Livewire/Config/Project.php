<?php

namespace App\Livewire\Config;

use App\Models\Project as ModelsProject;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Project extends Component
{
    public $title, $image, $getproject, $projectId = null;

    use LivewireAlert;
    use WithFileUploads;

    public function render()
    {
        return view('livewire.config.project', $this->getproject = ModelsProject::where("company_id", auth()->user()->company_id)->get());
    }

    public function storeOrUpdateProject()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
        ]);

        if ($this->projectId) {
            //manipulacao de arquivo;
            if ($this->image != null and !is_string($this->image)) {
                $fileName = rand(2000, 3000) .".".$this->image->getClientOriginalExtension();
                $this->image->storeAs("public/arquivos",$fileName);
            }
            // Atualizar projeto
            $project = ModelsProject::find($this->projectId);
            $project->update([
                "title" => $this->title, 
                "image" => $fileName
            ]);

            $this->alert('success', 
            'ACTUALIZADO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);

        } else {
            //manipulacao de arquivo;
            if ($this->image != null and !is_string($this->image)) {
                $fileName = rand(2000, 3000) .".".$this->image->getClientOriginalExtension();
                $this->image->storeAs("public/arquivos",$fileName);
            }
            // Adicionar novo projeto
            $project = ModelsProject::create([
                "title" => $this->title, 
                "company_id" => auth()->user()->company_id,
                "image" => $fileName
            ]);

            $this->alert('success', 
            'SUCESSO', [
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
            ]);
        }

        // Limpar campos
        $this->reset(['title', 'image', 'projectId']);
        $this->getProjects(); // Para atualizar a lista de projetos
    }

    public function edit($id)
    {
        $component = ModelsProject::find($id);
        $this->projectId = $component->id;
        $this->title = $component->title;
        $this->image = $component->image;
    }

    public function getProjects()
    {
        $this->getproject = ModelsProject::where("company_id", auth()->user()->company_id)->get();
    }

    public function deleteproject($id)
    {
        ModelsProject::find($id)->delete();

        $this->alert('success', 
        'ELIMINADO', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => false,
            'confirmButtonText' => 'OK',
        ]);
    }
}