<?php

namespace App\Http\Livewire\Loan;

use App\Repositories\LoanRepository;
use App\Services\LoanService;

use Livewire\Component;

class ReturnForm extends Component
{

	public $loan;
	public $late;
	public $fine;

	protected $listeners = ['returnBook' => 'setLoan'];

	public function setLoan(LoanRepository $repo, string $code)
	{
		$loan = $repo->getByCode($code);

		if ($loan) {
			$this->loan = $loan;
			$this->late = $loan->late;
			$this->fine = $loan->fine;
		} else {
			$this->emit('notFound');
		}

	}

	public function returnBook(LoanService $loan)
	{
		$loan->returnBook($this->loan->id);

		session()->flash('success', 'Sukses Mengembalikan Buku');
		return redirect('/loan');
	}

    public function render()
    {
        return view('livewire.loan.return-form');
    }
}
