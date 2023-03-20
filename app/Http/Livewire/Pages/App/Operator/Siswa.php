<?php

namespace App\Http\Livewire\Pages\App\Operator;

use App\Http\Enum\DataDefault;
use App\Http\Enum\RolesEnum;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Siswa extends Component
{
    public $queries = 'isKesiswaan';
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
    protected $paginationTheme = 'bootstrap';
    public $find = '';
    protected $queryString = ['find'];
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

    public function updatingFind()
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
            $this->redirect(route('kesiswaan', [$this->queries => $this->next]));
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

        User::create([
            'name' => $this->name,
            'email' => Str::lower(Str::substr($this->name, 0, 5) . $numberEmail . DataDefault::lastMail),
            'password' => DataDefault::number,
            'roles' => RolesEnum::STUDENTS
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
        $user = User::find($this->dataId);
        $user->delete();
        $this->successAlert('success',  'Berhasil menghapus akun ' . $user->name);
    }
    public function render()
    {
        return view('livewire.pages.app.operator.siswa', [
            'rolesStudents' => User::students()
                ->where('name', 'like', '%' . $this->find . '%')
                ->orderByDesc('created_at')->paginate($this->paginate)
        ]);
    }
}
