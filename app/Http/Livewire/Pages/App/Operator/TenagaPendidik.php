<?php

namespace App\Http\Livewire\Pages\App\Operator;

use App\Http\Enum\RolesEnum;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class TenagaPendidik extends Component
{
    public $queries = 'isTendik';
    public $next;

    public $dataId;
    public $name;
    public $isOpen = 0;
    public $password;
    public $email;
    public $paginate = 10;
    protected $listeners = [
        'resetForms'
    ];

    public $findTendik = '';

    protected $queryString = ['findTendik'];
    use WithPagination;

    public function updatingFindTendik()
    {
        $this->resetPage();
    }

    public function resetForms()
    {
        $this->name = $this->dataId = null;
        $this->resetErrorBag();
    }

    public function mount()
    {
        $this->next = request()->query($this->queries, null);
        if (!$this->next) {
            $this->next = auth()->user()->name  . '/' . Str::random(24);
            $this->redirect(route('tendik', [$this->queries => $this->next]));
        }
    }

    public function create()
    {
        $this->resetForms();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForms();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama lengkap harus diisikan.'
        ]);

        $numberEmail = mt_rand(1, 9999);

        User::updateOrCreate(['id' => $this->dataId], [
            'name' => $this->name,
            'email' => Str::lower(Str::substr($this->name, 0, 5) . $numberEmail . "@" . "cms.com"),
            'password' => Hash::make('12345678'),
            'roles' => 'teacher'
        ]);

        session()->flash(
            'message',
            $this->dataId ? 'Tenaga didik sukses diperbaharui.' : 'Tenaga didik sukses ditambahkan!.'
        );
        $this->dispatchBrowserEvent('hideModal');
        $this->resetForms();
    }

    public function resetPassword($dataId)
    {
        $resetPassword = User::find(decrypt($dataId));
        $this->dataId = $resetPassword->id;
        $this->email = $resetPassword->email;
    }

    public function resetPasswordHandle()
    {
        $user = User::find($this->dataId);
        $user->password = Hash::make('12345678');
        $user->save();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Berhasil setel ulang kata sandi ' . $user->name]
        );
    }

    public function deleteAccount($dataId)
    {
        $resetPassword = User::find(decrypt($dataId));
        $this->dataId = $resetPassword->id;
        $this->email = $resetPassword->email;
    }

    public function confirmAccountDelete()
    {
        $user = User::find($this->dataId);
        $user->delete();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Berhasil menghapus akun ' . $user->name]
        );

        $this->dispatchBrowserEvent('hideModal');
    }
    public function render()
    {
        return view('livewire.pages.app.operator.tenaga-pendidik', [
            'rolesTeachers' => User::isTeacher()
                ->where('name', 'like', '%' . $this->findTendik . '%')
                ->orderByDesc('created_at')->paginate($this->paginate)
        ])->layout('layouts.app');
    }
}
