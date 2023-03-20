<?php

namespace App\Http\Livewire\Pages\App\Operator;

use App\Http\Enum\DataDefault;
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
    public $tendik;

    public $dataId;
    public $name;
    public $isOpen = 0;
    public $password;
    public $email;
    public $paginate = 10;
    protected $listeners = [
        'resetForms'
    ];

    public $selectedItems = [];
    public $buttonDeleteSelect = false;
    public $selectAll = false;
    public $selectedCount = 0;
    public $findTendik = '';

    protected $queryString = ['findTendik'];
    use WithPagination;

    // alert
    public function successAlert($type, $message = null)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => $type,  'message' => $message]
        );
        $this->dispatchBrowserEvent('hideModal');
    }

    public function mount()
    {
        $this->next = request()->query($this->queries, null);
        if (!$this->next) {
            $this->next = auth()->user()->name  . '/' . Str::random(24);
            $this->redirect(route('tendik', [$this->queries => $this->next]));
        }
        $this->tendik = User::get();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = $this->tendik
                ->whereNotIn('id', '1')
                ->operator()->pluck('id')->map(function ($id) {
                    return (string) $id;
                });
        } else {
            $this->selectedItems = [];
        }
        $this->updateSelectedCount();
    }
    public function updatedSelectedItems()
    {
        $this->buttonDeleteSelect = count($this->selectedItems) > 0;
        $this->updateSelectedCount();
    }

    public function updateSelectedCount()
    {
        $this->selectedCount = count($this->selectedItems);
    }

    public function deleteSelected()
    {
        User::whereIn('id', $this->selectedItems)->delete();
        $this->tendik = User::query()->get();
        $this->selectedItems = [];
        $this->buttonDeleteSelect = false;
        $this->selectedCount = 0;
        $this->successAlert('success', 'Berhasil menghapus akun guru');
    }

    public function updatingFindTendik()
    {
        $this->resetPage();
    }

    public function resetForms()
    {
        $this->name = $this->dataId = null;
        $this->resetErrorBag();
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

        User::create([
            'name' => $this->name,
            'email' => Str::lower(Str::substr($this->name, 0, 5) . $numberEmail . DataDefault::lastMail),
            'password' => Hash::make(DataDefault::number),
            'roles' => RolesEnum::TEACHER
        ]);
        $this->successAlert('success', 'Berhasil menambahkan data baru');
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
        $user->password = DataDefault::number;
        $user->save();
        $this->successAlert('success', 'Akun ' . $user->name . ' setel ulang dengan default ' . '<b>' . DataDefault::number . '</b>');
    }

    public function deleteAccount($dataId)
    {
        $resetPassword = User::find(decrypt($dataId));
        $this->dataId = $resetPassword->id;
        $this->email = $resetPassword->email;
    }

    public function confirmAccountDelete()
    {
        $user = User::findOrFail($this->dataId);
        $user->delete();
        $this->successAlert('success', 'Berhasil menghapus akun ' . $user->name);
    }
    public function render()
    {
        return view('livewire.pages.app.operator.tenaga-pendidik', [
            'rolesTeachers' => User::teacher()
                ->where('name', 'like', '%' . $this->findTendik . '%')
                ->orderByDesc('created_at')->paginate($this->paginate)
        ]);
    }
}
