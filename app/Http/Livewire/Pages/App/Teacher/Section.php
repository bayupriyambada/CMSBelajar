<?php

namespace App\Http\Livewire\Pages\App\Teacher;

use App\Models\Courses;
use App\Models\Sections;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Section extends Component
{
    public $next;
    public $data;
    public $queries = 'isSection';
    public $name;
    public $paginate = 10;
    public $slug;
    protected $listeners = [
        'resetForms'
    ];
    protected $paginationTheme = 'bootstrap';
    public $find = '';
    protected $queryString = ['find'];
    use WithPagination;
    public $dataId;


    public function mount()
    {
        $this->next = request()->query($this->queries, null);
        $this->data = Sections::where('courses_id', $this->dataId)->first();
        dd($this->data);

        // dd($courses);
        // dd(request()->input($this->dataId));
        // $data = Courses::find($this->dataId);
        // $data = Courses::where('slug', $this->slug)->first();
        // dd($data);
        // if (!$this->data) {
        //     return redirect()->back();
        // }
        // if (!$this->next) {
        //     $this->next = auth()->user()->name  . '/' . Str::random(24);
        //     $this->redirect(route('section', $data, [$this->queries => $this->next]));
        // }
    }

    public function updatingFind()
    {
        $this->resetPage();
    }

    public function resetForms()
    {
        $this->name = $this->dataId = null;
        $this->resetErrorBag();
    }

    // alert
    public function successAlert($type, $message = null)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => $type,  'message' => $message]
        );
        $this->dispatchBrowserEvent('hideModal');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama materi harus diisikan.'
        ]);
        Sections::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'user_id' => auth()->id()
        ]);

        $this->successAlert('success', 'Berhasil menambahkan data baru');
        $this->resetForms();
    }

    public function edit($dataId)
    {
        $resetPassword = Sections::find(decrypt($dataId));
        $this->dataId = $resetPassword->id;
        $this->name = $resetPassword->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama materi harus diisikan.'
        ]);

        Sections::find($this->dataId)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'user_id' => auth()->id()
        ]);

        $this->successAlert('success', 'Berhasil merubah data');
        $this->resetForms();
    }
    public function delete($dataId)
    {
        $findDelete = Sections::find(decrypt($dataId));
        $this->dataId = $findDelete->id;
        $this->name = $findDelete->name;
    }
    public function confirmDelete()
    {
        $courses = Sections::find($this->dataId);
        $courses->delete();
        $this->successAlert('success',  'Berhasil menghapus akun ' . $courses->name);
    }
    public function render()
    {
        return view('livewire.pages.app.teacher.section');
    }
}
